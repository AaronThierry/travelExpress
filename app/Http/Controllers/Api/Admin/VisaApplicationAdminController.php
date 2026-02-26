<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication;
use App\Models\VisaDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VisaApplicationAdminController extends Controller
{
    /**
     * List all visa applications
     */
    public function index(Request $request)
    {
        $query = VisaApplication::with('documents')
            ->when($request->get('status'), fn($q, $s) => $q->where('status', $s))
            ->when($request->get('search'), function ($q, $search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('student_name', 'like', "%{$search}%")
                       ->orWhere('student_email', 'like', "%{$search}%");
                });
            })
            ->latest();

        $applications = $query->paginate($request->get('per_page', 20));

        return response()->json([
            'success' => true,
            'data'    => $applications->items(),
            'meta'    => [
                'total'        => $applications->total(),
                'current_page' => $applications->currentPage(),
                'last_page'    => $applications->lastPage(),
            ],
        ]);
    }

    /**
     * Create a new visa application
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name'    => 'nullable|string|max:255',
            'student_email'   => 'nullable|email|max:255',
            'student_phone'   => 'nullable|string|max:30',
            'passport_number' => 'nullable|string|max:50',
            'admin_notes'     => 'nullable|string',
        ]);

        $visa = VisaApplication::create($validated);
        $visa->generateAccessToken(60);

        $emailSent = false;
        if (!empty($visa->student_email)) {
            try {
                Mail::send('emails.visa-dossier-link', [
                    'visa'      => $visa,
                    'accessUrl' => $visa->student_form_url,
                    'expiresAt' => $visa->token_expires_at?->format('d/m/Y'),
                ], function ($message) use ($visa) {
                    $message->to($visa->student_email, $visa->student_name ?? $visa->student_email)
                            ->subject('Votre dossier visa — Travel Express');
                });
                $emailSent = true;
            } catch (\Exception $e) {
                // Email failure does not block creation
            }
        }

        return response()->json([
            'success'    => true,
            'message'    => 'Dossier visa créé avec succès.' . ($emailSent ? ' Un e-mail a été envoyé à l\'étudiant.' : ''),
            'data'       => $visa,
            'access_url' => $visa->student_form_url,
            'email_sent' => $emailSent,
        ], 201);
    }

    /**
     * Show a single visa application
     */
    public function show($id)
    {
        $visa = VisaApplication::with(['documents', 'reviewer'])->findOrFail($id);

        return response()->json([
            'success'     => true,
            'application' => $visa,
            'documents'   => VisaApplication::DOCUMENTS,
            'docs'        => $visa->documents->values(),
            'access_url'  => $visa->student_form_url,
        ]);
    }

    /**
     * Update a visa application
     */
    public function update(Request $request, $id)
    {
        $visa = VisaApplication::findOrFail($id);

        $validated = $request->validate([
            'student_name'    => 'nullable|string|max:255',
            'student_email'   => 'nullable|email|max:255',
            'student_phone'   => 'nullable|string|max:30',
            'passport_number' => 'nullable|string|max:50',
            'status'          => 'nullable|in:pending,in_progress,complete,approved,rejected',
            'admin_notes'     => 'nullable|string',
        ]);

        if (isset($validated['status']) && in_array($validated['status'], ['approved', 'rejected'])) {
            $validated['reviewed_at'] = now();
            $validated['reviewed_by'] = auth()->id();
        }

        $visa->update($validated);

        return response()->json(['success' => true, 'message' => 'Dossier mis à jour.', 'data' => $visa]);
    }

    /**
     * Delete a visa application
     */
    public function destroy($id)
    {
        $visa = VisaApplication::with('documents')->findOrFail($id);

        foreach ($visa->documents as $doc) {
            $doc->delete(); // triggers file deletion via model boot
        }

        $visa->delete();

        return response()->json(['success' => true, 'message' => 'Dossier visa supprimé.']);
    }

    /**
     * Generate / regenerate student access token
     */
    public function generateToken(Request $request, $id)
    {
        $visa    = VisaApplication::findOrFail($id);
        $days    = $request->get('expires_in_days', 60);
        $token   = $visa->generateAccessToken($days);

        return response()->json([
            'success'    => true,
            'message'    => 'Lien généré avec succès.',
            'token'      => $token,
            'access_url' => $visa->student_form_url,
            'expires_at' => $visa->token_expires_at?->format('d/m/Y'),
        ]);
    }

    /**
     * Approve a document
     */
    public function approveDocument($documentId)
    {
        $document = VisaDocument::findOrFail($documentId);
        $document->update([
            'status'      => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Document approuvé.']);
    }

    /**
     * Reject a document
     */
    public function rejectDocument(Request $request, $documentId)
    {
        $document = VisaDocument::findOrFail($documentId);

        $request->validate(['reason' => 'nullable|string|max:500']);

        $document->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->get('reason'),
            'reviewed_by'      => auth()->id(),
            'reviewed_at'      => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Document rejeté.']);
    }

    /**
     * Statistics
     */
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data'    => [
                'total'       => VisaApplication::count(),
                'pending'     => VisaApplication::where('status', 'pending')->count(),
                'in_progress' => VisaApplication::where('status', 'in_progress')->count(),
                'complete'    => VisaApplication::where('status', 'complete')->count(),
                'approved'    => VisaApplication::where('status', 'approved')->count(),
                'rejected'    => VisaApplication::where('status', 'rejected')->count(),
            ],
        ]);
    }
}

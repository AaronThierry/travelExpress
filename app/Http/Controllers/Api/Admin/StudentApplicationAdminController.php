<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentApplication;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;

class StudentApplicationAdminController extends Controller
{
    /**
     * List all applications
     */
    public function index(Request $request)
    {
        $query = StudentApplication::with(['documents', 'reviewer']);

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by program type
        if ($request->has('program_type') && $request->program_type !== 'all') {
            $query->where('program_type', $request->program_type);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('student_email', 'like', "%{$search}%")
                  ->orWhere('passport_number', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $applications = $query->paginate(20);

        return response()->json($applications);
    }

    /**
     * Get single application details
     */
    public function show($id)
    {
        $application = StudentApplication::with(['documents', 'reviewer'])
            ->findOrFail($id);

        $requiredDocuments = StudentApplication::getRequiredDocuments($application->program_type);

        return response()->json([
            'application' => $application,
            'required_documents' => $requiredDocuments,
            'completion_percentage' => $application->completion_percentage,
            'is_complete' => $application->is_complete
        ]);
    }

    /**
     * Create new application and generate link
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_type' => 'required|in:license,master',
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_phone' => 'nullable|string|max:20',
        ]);

        $application = StudentApplication::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dossier créé avec succès',
            'application' => $application,
            'upload_link' => $application->upload_link
        ], 201);
    }

    /**
     * Update application status or notes
     */
    public function update(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            'status' => 'nullable|in:pending,incomplete,complete,approved,rejected',
            'admin_notes' => 'nullable|string',
            'student_name' => 'nullable|string|max:255',
            'student_email' => 'nullable|email|max:255',
            'student_phone' => 'nullable|string|max:20',
        ]);

        if (isset($validated['status']) && in_array($validated['status'], ['approved', 'rejected'])) {
            $validated['reviewed_at'] = now();
            $validated['reviewed_by'] = auth()->id();
        }

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dossier mis à jour',
            'application' => $application->load(['documents', 'reviewer'])
        ]);
    }

    /**
     * Delete application
     */
    public function destroy($id)
    {
        $application = StudentApplication::findOrFail($id);
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dossier supprimé'
        ]);
    }

    /**
     * Approve a document
     */
    public function approveDocument($documentId)
    {
        $document = ApplicationDocument::findOrFail($documentId);

        $document->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document approuvé',
            'document' => $document
        ]);
    }

    /**
     * Reject a document
     */
    public function rejectDocument(Request $request, $documentId)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $document = ApplicationDocument::findOrFail($documentId);

        $document->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $validated['rejection_reason']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document rejeté',
            'document' => $document
        ]);
    }

    /**
     * Get statistics
     */
    public function stats()
    {
        $stats = [
            'total' => StudentApplication::count(),
            'pending' => StudentApplication::where('status', 'pending')->count(),
            'incomplete' => StudentApplication::where('status', 'incomplete')->count(),
            'complete' => StudentApplication::where('status', 'complete')->count(),
            'approved' => StudentApplication::where('status', 'approved')->count(),
            'rejected' => StudentApplication::where('status', 'rejected')->count(),
            'license' => StudentApplication::where('program_type', 'license')->count(),
            'master' => StudentApplication::where('program_type', 'master')->count(),
        ];

        return response()->json($stats);
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentApplication;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentApplicationAdminController extends Controller
{
    /**
     * List all applications with unified view
     */
    public function index(Request $request)
    {
        $query = StudentApplication::with(['documents', 'reviewer']);

        // Filter by status (initial dossier)
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by complementary status
        if ($request->has('complementary_status') && $request->complementary_status !== 'all') {
            $query->where('complementary_status', $request->complementary_status);
        }

        // Filter by program type
        if ($request->has('program_type') && $request->program_type !== 'all') {
            $query->where('program_type', $request->program_type);
        }

        // Filter by current step
        if ($request->has('current_step') && $request->current_step !== 'all') {
            $query->where('current_step', $request->current_step);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('student_email', 'like', "%{$search}%")
                  ->orWhere('passport_number', 'like', "%{$search}%")
                  ->orWhere('numero_chinois', 'like', "%{$search}%")
                  ->orWhere('university_name', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $applications = $query->paginate(20);

        // Add computed attributes to each application
        $applications->getCollection()->transform(function ($app) {
            $app->completion_percentage = $app->completion_percentage;
            $app->complementary_completion_percentage = $app->complementary_completion_percentage;
            $app->overall_completion_percentage = $app->overall_completion_percentage;
            $app->is_complete = $app->is_complete;
            $app->is_complementary_complete = $app->is_complementary_complete;
            $app->current_step_label = $app->current_step_label;
            $app->status_info = $app->status_info;
            $app->complementary_status_info = $app->complementary_status_info;
            $app->has_complementary_data = $app->has_complementary_data;
            return $app;
        });

        return response()->json($applications);
    }

    /**
     * Get single application details with unified view
     */
    public function show($id)
    {
        $application = StudentApplication::with(['documents', 'reviewer'])
            ->findOrFail($id);

        $requiredDocuments = StudentApplication::getRequiredDocuments($application->program_type);
        $complementaryDocuments = StudentApplication::getComplementaryDocuments();

        // Separate documents by type
        $initialDocs = $application->documents->filter(function($doc) use ($requiredDocuments) {
            return array_key_exists($doc->document_type, $requiredDocuments);
        });

        $compDocs = $application->documents->filter(function($doc) use ($complementaryDocuments) {
            return array_key_exists($doc->document_type, $complementaryDocuments);
        });

        return response()->json([
            'application' => $application,
            'required_documents' => $requiredDocuments,
            'complementary_documents' => $complementaryDocuments,
            'initial_docs' => $initialDocs->values(),
            'complementary_docs' => $compDocs->values(),
            'completion_percentage' => $application->completion_percentage,
            'complementary_completion_percentage' => $application->complementary_completion_percentage,
            'overall_completion_percentage' => $application->overall_completion_percentage,
            'is_complete' => $application->is_complete,
            'is_complementary_complete' => $application->is_complementary_complete,
            'current_step_label' => $application->current_step_label,
            'status_info' => $application->status_info,
            'complementary_status_info' => $application->complementary_status_info,
            'student_form_url' => $application->student_form_url,
            'upload_link' => $application->upload_link,
            'token_expires_at' => $application->token_expires_at?->format('d/m/Y H:i'),
            'is_token_valid' => $application->isTokenValid(),
        ]);
    }

    /**
     * Create new application and generate link
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_type' => 'required|in:license,master',
            'student_name' => 'nullable|string|max:255',
            'student_email' => 'nullable|email|max:255',
            'student_phone' => 'nullable|string|max:20',
            'dossier_type' => 'nullable|in:nouveau,complementaire',
            'expires_in_days' => 'nullable|integer|min:1|max:365',
        ]);

        $validated['dossier_type'] = $validated['dossier_type'] ?? 'nouveau';
        $validated['current_step'] = $validated['dossier_type'] === 'complementaire' ? 2 : 1;
        $validated['complementary_status'] = $validated['dossier_type'] === 'complementaire' ? 'in_progress' : 'not_started';

        // Remove expires_in_days from validated data before create
        $expiresInDays = $validated['expires_in_days'] ?? 30;
        unset($validated['expires_in_days']);

        $application = StudentApplication::create($validated);

        // Generate access token
        $application->generateAccessToken($expiresInDays);

        return response()->json([
            'success' => true,
            'message' => 'Dossier créé avec succès',
            'application' => $application->fresh(),
            'upload_link' => $application->upload_link,
            'student_form_url' => $application->student_form_url,
            'token_expires_at' => $application->token_expires_at?->format('d/m/Y H:i'),
        ], 201);
    }

    /**
     * Update application (both initial and complementary data)
     */
    public function update(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            // Initial dossier fields
            'status' => 'nullable|in:pending,incomplete,complete,approved,rejected',
            'admin_notes' => 'nullable|string',
            'student_name' => 'nullable|string|max:255',
            'student_email' => 'nullable|email|max:255',
            'student_phone' => 'nullable|string|max:20',
            'passport_number' => 'nullable|string|max:50',

            // Complementary dossier fields
            'visa_current' => 'nullable|string|max:255',
            'casier_judiciaire_valide' => 'nullable|boolean',
            'complement_application' => 'nullable|string',
            'numero_chinois' => 'nullable|string|max:30',
            'complementary_status' => 'nullable|in:not_started,in_progress,submitted,approved,rejected',
            'current_step' => 'nullable|integer|min:1|max:3',

            // Additional student info
            'university_name' => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'admission_year' => 'nullable|integer|min:2000|max:2050',
        ]);

        // Handle initial dossier status changes
        if (isset($validated['status']) && in_array($validated['status'], ['approved', 'rejected'])) {
            $validated['reviewed_at'] = now();
            $validated['reviewed_by'] = auth()->id();
        }

        // Handle complementary status changes
        if (isset($validated['complementary_status'])) {
            if ($validated['complementary_status'] === 'submitted' && !$application->complementary_submitted_at) {
                $validated['complementary_submitted_at'] = now();
            }

            // Auto-update current step based on complementary status
            if ($validated['complementary_status'] === 'in_progress' && $application->current_step < 2) {
                $validated['current_step'] = 2;
            } elseif ($validated['complementary_status'] === 'approved') {
                $validated['current_step'] = 3;
            }
        }

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dossier mis à jour',
            'application' => $application->load(['documents', 'reviewer'])
        ]);
    }

    /**
     * Update complementary data specifically
     */
    public function updateComplementary(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            'visa_current' => 'nullable|string|max:255',
            'casier_judiciaire_valide' => 'nullable|boolean',
            'complement_application' => 'nullable|string',
            'numero_chinois' => 'nullable|string|max:30',
            'complementary_status' => 'nullable|in:not_started,in_progress,submitted,approved,rejected',
            'university_name' => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'admission_year' => 'nullable|integer|min:2000|max:2050',
        ]);

        // Auto-set status to in_progress if adding data
        if ($application->complementary_status === 'not_started') {
            $hasData = !empty($validated['visa_current']) ||
                       !empty($validated['numero_chinois']) ||
                       isset($validated['casier_judiciaire_valide']);
            if ($hasData) {
                $validated['complementary_status'] = 'in_progress';
                $validated['current_step'] = 2;
            }
        }

        if (isset($validated['complementary_status']) && $validated['complementary_status'] === 'submitted') {
            $validated['complementary_submitted_at'] = now();
        }

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dossier complémentaire mis à jour',
            'application' => $application->fresh(['documents', 'reviewer']),
            'complementary_completion_percentage' => $application->fresh()->complementary_completion_percentage,
        ]);
    }

    /**
     * Upload complementary document (bilan santé chinois)
     */
    public function uploadComplementaryFile(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'type' => 'required|in:bilan_sante_chinois',
        ]);

        $file = $request->file('file');
        $path = $file->store('student-applications/complementary', 'public');

        if ($validated['type'] === 'bilan_sante_chinois') {
            // Delete old file if exists
            if ($application->bilan_sante_chinois_path) {
                Storage::disk('public')->delete($application->bilan_sante_chinois_path);
            }
            $application->update(['bilan_sante_chinois_path' => $path]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Fichier téléchargé avec succès',
            'path' => $path,
            'url' => Storage::disk('public')->url($path),
        ]);
    }

    /**
     * Delete application
     */
    public function destroy($id)
    {
        $application = StudentApplication::findOrFail($id);

        // Delete complementary file if exists
        if ($application->bilan_sante_chinois_path) {
            Storage::disk('public')->delete($application->bilan_sante_chinois_path);
        }

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
     * Get statistics with complementary data
     */
    public function stats()
    {
        $stats = [
            // Initial dossier stats
            'total' => StudentApplication::count(),
            'pending' => StudentApplication::where('status', 'pending')->count(),
            'incomplete' => StudentApplication::where('status', 'incomplete')->count(),
            'complete' => StudentApplication::where('status', 'complete')->count(),
            'approved' => StudentApplication::where('status', 'approved')->count(),
            'rejected' => StudentApplication::where('status', 'rejected')->count(),

            // Program types
            'license' => StudentApplication::where('program_type', 'license')->count(),
            'master' => StudentApplication::where('program_type', 'master')->count(),

            // Complementary dossier stats
            'complementary_not_started' => StudentApplication::where('complementary_status', 'not_started')->count(),
            'complementary_in_progress' => StudentApplication::where('complementary_status', 'in_progress')->count(),
            'complementary_submitted' => StudentApplication::where('complementary_status', 'submitted')->count(),
            'complementary_approved' => StudentApplication::where('complementary_status', 'approved')->count(),
            'complementary_rejected' => StudentApplication::where('complementary_status', 'rejected')->count(),

            // Step distribution
            'step_1' => StudentApplication::where('current_step', 1)->count(),
            'step_2' => StudentApplication::where('current_step', 2)->count(),
            'step_3' => StudentApplication::where('current_step', 3)->count(),

            // Fully complete (both dossiers approved)
            'fully_complete' => StudentApplication::where('status', 'approved')
                ->where('complementary_status', 'approved')
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Advance application to next step
     */
    public function advanceStep($id)
    {
        $application = StudentApplication::findOrFail($id);

        if ($application->current_step >= 3) {
            return response()->json([
                'success' => false,
                'message' => 'Le dossier est déjà à l\'étape finale'
            ], 400);
        }

        $application->update([
            'current_step' => $application->current_step + 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Dossier avancé à l\'étape ' . $application->current_step,
            'application' => $application->fresh()
        ]);
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:student_applications,id',
            'status' => 'nullable|in:pending,incomplete,complete,approved,rejected',
            'complementary_status' => 'nullable|in:not_started,in_progress,submitted,approved,rejected',
        ]);

        $updateData = [];
        if (isset($validated['status'])) {
            $updateData['status'] = $validated['status'];
            if (in_array($validated['status'], ['approved', 'rejected'])) {
                $updateData['reviewed_at'] = now();
                $updateData['reviewed_by'] = auth()->id();
            }
        }
        if (isset($validated['complementary_status'])) {
            $updateData['complementary_status'] = $validated['complementary_status'];
        }

        StudentApplication::whereIn('id', $validated['ids'])->update($updateData);

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' dossiers mis à jour'
        ]);
    }

    /**
     * Generate access token for student
     */
    public function generateToken(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            'expires_in_days' => 'nullable|integer|min:1|max:365',
        ]);

        $expiresInDays = $validated['expires_in_days'] ?? 30;
        $token = $application->generateAccessToken($expiresInDays);

        return response()->json([
            'success' => true,
            'message' => 'Lien généré avec succès',
            'data' => [
                'access_token' => $token,
                'student_form_url' => $application->student_form_url,
                'expires_at' => $application->token_expires_at->format('d/m/Y H:i'),
                'expires_in_days' => $expiresInDays,
            ]
        ]);
    }

    /**
     * Regenerate access token (invalidates old one)
     */
    public function regenerateToken(Request $request, $id)
    {
        $application = StudentApplication::findOrFail($id);

        $validated = $request->validate([
            'expires_in_days' => 'nullable|integer|min:1|max:365',
        ]);

        $expiresInDays = $validated['expires_in_days'] ?? 30;
        $token = $application->generateAccessToken($expiresInDays);

        return response()->json([
            'success' => true,
            'message' => 'Nouveau lien généré avec succès. L\'ancien lien est maintenant invalide.',
            'data' => [
                'access_token' => $token,
                'student_form_url' => $application->student_form_url,
                'expires_at' => $application->token_expires_at->format('d/m/Y H:i'),
                'expires_in_days' => $expiresInDays,
            ]
        ]);
    }
}

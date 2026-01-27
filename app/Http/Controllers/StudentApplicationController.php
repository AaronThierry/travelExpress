<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use ZipArchive;

class StudentApplicationController extends Controller
{
    /**
     * Show the upload form for a student using their access token
     */
    public function showUploadForm($token)
    {
        // Try new access_token first, fallback to unique_token for backward compatibility
        $application = StudentApplication::findByToken($token);

        if (!$application) {
            // Fallback to unique_token
            $application = StudentApplication::where('unique_token', $token)->first();
        }

        if (!$application) {
            return view('student.application-invalid');
        }

        $requiredDocuments = StudentApplication::getRequiredDocuments($application->program_type);
        $complementaryDocuments = StudentApplication::getComplementaryDocuments();
        $uploadedDocuments = $application->documents->keyBy('document_type');

        return view('student.upload', compact(
            'application',
            'requiredDocuments',
            'complementaryDocuments',
            'uploadedDocuments'
        ));
    }

    /**
     * Handle document upload
     */
    public function uploadDocument(Request $request, $token)
    {
        $application = $this->findApplication($token);

        if (!$application) {
            return response()->json(['error' => 'Lien invalide ou expiré'], 404);
        }

        $validator = Validator::make($request->all(), [
            'document_type' => 'required|string',
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,webp'
        ], [
            'file.required' => 'Veuillez sélectionner un fichier.',
            'file.max' => 'Le fichier ne doit pas dépasser 10 Mo.',
            'file.mimes' => 'Format accepté: PDF, JPG, PNG, DOC, DOCX, WebP.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $documentType = $request->document_type;
        $file = $request->file('file');

        // Check if document type is valid for initial or complementary dossier
        $requiredDocs = StudentApplication::getRequiredDocuments($application->program_type);
        $complementaryDocs = StudentApplication::getComplementaryDocuments();
        $allValidDocs = array_merge($requiredDocs, $complementaryDocs);

        if (!array_key_exists($documentType, $allValidDocs)) {
            return response()->json(['error' => 'Type de document invalide'], 422);
        }

        // Determine if this is a complementary document
        $isComplementary = array_key_exists($documentType, $complementaryDocs);

        // Delete existing document if any
        $existingDoc = $application->documents()->where('document_type', $documentType)->first();
        if ($existingDoc) {
            Storage::disk('private')->delete($existingDoc->file_path);
            $existingDoc->delete();
        }

        // Store the file
        $filename = time() . '_' . $documentType . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs(
            "student_applications/{$application->id}/{$documentType}",
            $filename,
            'private'
        );

        // Create document record
        $document = ApplicationDocument::create([
            'application_id' => $application->id,
            'document_type' => $documentType,
            'file_path' => $path,
            'original_filename' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'status' => 'pending',
            'is_complementary' => $isComplementary,
        ]);

        // Refresh to get updated completion percentages
        $application->refresh();

        // Update application status based on completion
        $this->updateApplicationStatus($application);

        return response()->json([
            'success' => true,
            'message' => 'Document uploadé avec succès',
            'document' => [
                'id' => $document->id,
                'type' => $document->document_type,
                'filename' => $document->original_filename,
                'size' => $document->file_size_human ?? $this->formatBytes($document->file_size),
                'status' => $document->status,
                'is_complementary' => $isComplementary,
            ],
            'completion_percentage' => $application->completion_percentage,
            'complementary_completion_percentage' => $application->complementary_completion_percentage,
        ]);
    }

    /**
     * Update student information
     */
    public function updateInfo(Request $request, $token)
    {
        $application = $this->findApplication($token);

        if (!$application) {
            return response()->json(['error' => 'Lien invalide ou expiré'], 404);
        }

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|max:255',
            'student_phone' => 'nullable|string|max:30',
            'passport_number' => 'nullable|string|max:50',
            // Complementary fields
            'visa_current' => 'nullable|string|max:100',
            'numero_chinois' => 'nullable|string|max:50',
            'complement_application' => 'nullable|string|max:2000',
        ], [
            'student_name.required' => 'Le nom complet est obligatoire.',
            'student_email.required' => 'L\'adresse email est obligatoire.',
            'student_email.email' => 'L\'adresse email n\'est pas valide.',
        ]);

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Informations mises à jour avec succès',
            'data' => $application->fresh(),
        ]);
    }

    /**
     * Delete a document
     */
    public function deleteDocument($token, $documentId)
    {
        $application = $this->findApplication($token);

        if (!$application) {
            return response()->json(['error' => 'Lien invalide ou expiré'], 404);
        }

        $document = $application->documents()->findOrFail($documentId);

        // Don't allow deletion of approved documents
        if ($document->status === 'approved') {
            return response()->json([
                'error' => 'Ce document a été approuvé et ne peut pas être supprimé.'
            ], 403);
        }

        Storage::disk('private')->delete($document->file_path);
        $document->delete();

        $application->refresh();

        // Update application status
        $this->updateApplicationStatus($application);

        return response()->json([
            'success' => true,
            'message' => 'Document supprimé',
            'completion_percentage' => $application->completion_percentage,
            'complementary_completion_percentage' => $application->complementary_completion_percentage,
        ]);
    }

    /**
     * Submit application
     */
    public function submitApplication($token)
    {
        $application = $this->findApplication($token);

        if (!$application) {
            return response()->json(['error' => 'Lien invalide ou expiré'], 404);
        }

        // Validate required fields
        if (empty($application->student_name) || empty($application->student_email)) {
            return response()->json([
                'error' => 'Veuillez remplir tous les champs obligatoires (nom et email).'
            ], 422);
        }

        // Check minimum completion based on dossier type
        if ($application->dossier_type === 'nouveau' || $application->dossier_type === null) {
            if ($application->completion_percentage < 30) {
                return response()->json([
                    'error' => 'Veuillez télécharger au moins quelques documents requis avant de soumettre.'
                ], 422);
            }
        }

        $application->update([
            'status' => 'pending',
            'submitted_at' => now(),
            'student_submitted_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Dossier soumis avec succès ! Vous recevrez une confirmation par email.'
        ]);
    }

    /**
     * Get current application status (for polling)
     */
    public function getStatus($token)
    {
        $application = $this->findApplication($token);

        if (!$application) {
            return response()->json(['error' => 'Lien invalide ou expiré'], 404);
        }

        $application->load('documents');

        return response()->json([
            'success' => true,
            'data' => [
                'status' => $application->status,
                'status_info' => $application->status_info,
                'dossier_type' => $application->dossier_type,
                'completion_percentage' => $application->completion_percentage,
                'complementary_completion_percentage' => $application->complementary_completion_percentage,
                'overall_completion_percentage' => $application->overall_completion_percentage,
                'current_step' => $application->current_step,
                'current_step_label' => $application->current_step_label,
                'submitted_at' => $application->student_submitted_at?->format('d/m/Y H:i'),
                'documents' => $application->documents->map(function ($doc) {
                    return [
                        'id' => $doc->id,
                        'document_type' => $doc->document_type,
                        'status' => $doc->status,
                        'original_filename' => $doc->original_filename,
                        'uploaded_at' => $doc->created_at->format('d/m/Y H:i'),
                    ];
                }),
            ],
        ]);
    }

    /**
     * Download a document (for admin or student)
     */
    public function downloadDocument($documentId)
    {
        $document = ApplicationDocument::findOrFail($documentId);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Fichier introuvable');
        }

        return Storage::disk('private')->download(
            $document->file_path,
            $document->original_filename
        );
    }

    /**
     * Download all documents as ZIP
     */
    public function downloadAllDocuments($applicationId)
    {
        $application = StudentApplication::with('documents')->findOrFail($applicationId);

        $zipFileName = 'dossier_' . str_replace(' ', '_', $application->student_name) . '_' . time() . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        // Create temp directory if it doesn't exist
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Impossible de créer l\'archive');
        }

        foreach ($application->documents as $document) {
            $filePath = storage_path('app/private/' . $document->file_path);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $document->document_type . '/' . $document->original_filename);
            }
        }

        $zip->close();

        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }

    /**
     * Preview document inline (for admin)
     */
    public function previewDocument($documentId)
    {
        $document = ApplicationDocument::findOrFail($documentId);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Fichier introuvable');
        }

        $filePath = storage_path('app/private/' . $document->file_path);

        return response()->file($filePath, [
            'Content-Type' => $document->mime_type,
            'Content-Disposition' => 'inline; filename="' . $document->original_filename . '"'
        ]);
    }

    /**
     * Helper: Find application by token (access_token or unique_token)
     */
    private function findApplication($token)
    {
        // Try new access_token first
        $application = StudentApplication::findByToken($token);

        if (!$application) {
            // Fallback to unique_token for backward compatibility
            $application = StudentApplication::where('unique_token', $token)->first();
        }

        return $application;
    }

    /**
     * Helper: Update application status based on completion
     */
    private function updateApplicationStatus(StudentApplication $application)
    {
        if ($application->student_submitted_at) {
            // Already submitted, don't change status
            return;
        }

        if ($application->is_complete) {
            $application->update(['status' => 'complete']);
        } else {
            $application->update(['status' => 'incomplete']);
        }
    }

    /**
     * Helper: Format bytes to human readable
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['o', 'Ko', 'Mo', 'Go'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

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
     * Show the upload form for a student using their unique token
     */
    public function showUploadForm($token)
    {
        $application = StudentApplication::where('unique_token', $token)->firstOrFail();

        $requiredDocuments = StudentApplication::getRequiredDocuments($application->program_type);
        $uploadedDocuments = $application->documents->keyBy('document_type');

        return view('student.upload', compact('application', 'requiredDocuments', 'uploadedDocuments'));
    }

    /**
     * Handle document upload
     */
    public function uploadDocument(Request $request, $token)
    {
        $application = StudentApplication::where('unique_token', $token)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'document_type' => 'required|string',
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $documentType = $request->document_type;
        $file = $request->file('file');

        // Check if document type is valid for this program
        $requiredDocs = StudentApplication::getRequiredDocuments($application->program_type);
        if (!array_key_exists($documentType, $requiredDocs)) {
            return response()->json(['error' => 'Type de document invalide'], 422);
        }

        // Delete existing document if any
        $existingDoc = $application->documents()->where('document_type', $documentType)->first();
        if ($existingDoc) {
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
            'status' => 'pending'
        ]);

        // Update application status
        if ($application->is_complete && !$application->submitted_at) {
            $application->update([
                'status' => 'complete',
                'submitted_at' => now()
            ]);
        } elseif (!$application->submitted_at) {
            $application->update(['status' => 'incomplete']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Document uploadé avec succès',
            'document' => [
                'id' => $document->id,
                'type' => $document->document_type,
                'filename' => $document->original_filename,
                'size' => $document->file_size_human,
                'status' => $document->status
            ],
            'completion_percentage' => $application->completion_percentage
        ]);
    }

    /**
     * Delete a document
     */
    public function deleteDocument($token, $documentId)
    {
        $application = StudentApplication::where('unique_token', $token)->firstOrFail();
        $document = $application->documents()->findOrFail($documentId);

        $document->delete();

        // Update application status
        $application->update([
            'status' => $application->is_complete ? 'complete' : 'incomplete',
            'submitted_at' => $application->is_complete ? $application->submitted_at : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document supprimé',
            'completion_percentage' => $application->completion_percentage
        ]);
    }

    /**
     * Submit application
     */
    public function submitApplication($token)
    {
        $application = StudentApplication::where('unique_token', $token)->firstOrFail();

        if (!$application->is_complete) {
            return response()->json(['error' => 'Veuillez uploader tous les documents requis'], 422);
        }

        $application->update([
            'status' => 'complete',
            'submitted_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Dossier soumis avec succès. Vous recevrez une confirmation par email.'
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
     * Download all documents as ZIP (admin only)
     */
    public function downloadAllDocuments($applicationId)
    {
        $application = StudentApplication::with('documents')->findOrFail($applicationId);

        $zipFileName = 'dossier_' . $application->student_name . '_' . time() . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        // Create temp directory if it doesn't exist
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
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
}

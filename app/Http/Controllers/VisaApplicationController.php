<?php

namespace App\Http\Controllers;

use App\Models\VisaApplication;
use App\Models\VisaDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisaApplicationController extends Controller
{
    /**
     * Show upload form (student-facing, token-based)
     */
    public function show($token)
    {
        $visa = VisaApplication::findByToken($token);

        if (!$visa) {
            $visa = VisaApplication::where('unique_token', $token)->first();
        }

        if (!$visa) {
            return view('student.visa-invalid');
        }

        $documents        = VisaApplication::DOCUMENTS;
        $uploadedDocuments = $visa->documents->keyBy('document_type');

        return view('student.visa-upload', compact('visa', 'documents', 'uploadedDocuments'));
    }

    /**
     * Update student info
     */
    public function updateInfo(Request $request, $token)
    {
        $visa = $this->findVisa($token);
        if (!$visa) return response()->json(['error' => 'Lien invalide ou expiré'], 404);

        $validated = $request->validate([
            'student_name'    => 'required|string|max:255',
            'student_email'   => 'required|email|max:255',
            'student_phone'   => 'nullable|string|max:30',
            'passport_number' => 'nullable|string|max:50',
        ]);

        $visa->update($validated);

        return response()->json(['success' => true, 'message' => 'Informations mises à jour avec succès']);
    }

    /**
     * Upload a document
     */
    public function uploadDocument(Request $request, $token)
    {
        $visa = $this->findVisa($token);
        if (!$visa) return response()->json(['error' => 'Lien invalide ou expiré'], 404);

        $validator = Validator::make($request->all(), [
            'document_type' => 'required|string',
            'file'          => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,webp',
        ], [
            'file.required' => 'Veuillez sélectionner un fichier.',
            'file.max'      => 'Le fichier ne doit pas dépasser 10 Mo.',
            'file.mimes'    => 'Format accepté : PDF, JPG, PNG, DOC, DOCX, WebP.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $docType = $request->document_type;

        if (!array_key_exists($docType, VisaApplication::DOCUMENTS)) {
            return response()->json(['error' => 'Type de document invalide'], 422);
        }

        // Delete existing document
        $existing = $visa->documents()->where('document_type', $docType)->first();
        if ($existing) $existing->delete();

        $file     = $request->file('file');
        $filename = time() . '_' . $docType . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs("visa_applications/{$visa->id}/{$docType}", $filename, 'private');

        VisaDocument::create([
            'visa_application_id' => $visa->id,
            'document_type'       => $docType,
            'file_path'           => $path,
            'original_filename'   => $file->getClientOriginalName(),
            'file_size'           => $file->getSize(),
            'mime_type'           => $file->getMimeType(),
            'status'              => 'pending',
        ]);

        $visa->refresh();

        // Update status
        if ($visa->is_complete) {
            $visa->update(['status' => 'complete']);
        } elseif ($visa->status === 'pending') {
            $visa->update(['status' => 'in_progress']);
        }

        return response()->json([
            'success'               => true,
            'message'               => 'Document uploadé avec succès',
            'completion_percentage' => $visa->completion_percentage,
        ]);
    }

    /**
     * Delete a document
     */
    public function deleteDocument($token, $documentId)
    {
        $visa = $this->findVisa($token);
        if (!$visa) return response()->json(['error' => 'Lien invalide ou expiré'], 404);

        $document = $visa->documents()->findOrFail($documentId);

        if ($document->status === 'approved') {
            return response()->json(['error' => 'Ce document a été approuvé et ne peut pas être supprimé.'], 403);
        }

        $document->delete();
        $visa->refresh();

        if ($visa->is_complete) {
            $visa->update(['status' => 'complete']);
        } else {
            $visa->update(['status' => 'in_progress']);
        }

        return response()->json([
            'success'               => true,
            'message'               => 'Document supprimé',
            'completion_percentage' => $visa->completion_percentage,
        ]);
    }

    /**
     * Submit the visa dossier
     */
    public function submit($token)
    {
        $visa = $this->findVisa($token);
        if (!$visa) return response()->json(['error' => 'Lien invalide ou expiré'], 404);

        if (empty($visa->student_name) || empty($visa->student_email)) {
            return response()->json(['error' => 'Veuillez remplir votre nom et email avant de soumettre.'], 422);
        }

        $visa->update([
            'student_submitted_at' => now(),
            'submitted_at'         => now(),
            'status'               => 'complete',
        ]);

        return response()->json(['success' => true, 'message' => 'Dossier visa soumis avec succès !']);
    }

    /**
     * Download a document
     */
    public function downloadDocument($documentId)
    {
        $document = VisaDocument::findOrFail($documentId);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Fichier introuvable');
        }

        return Storage::disk('private')->download($document->file_path, $document->original_filename);
    }

    /**
     * Preview a document inline
     */
    public function previewDocument($documentId)
    {
        $document = VisaDocument::findOrFail($documentId);

        if (!Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'Fichier introuvable');
        }

        return response()->file(
            storage_path('app/private/' . $document->file_path),
            ['Content-Type' => $document->mime_type, 'Content-Disposition' => 'inline; filename="' . $document->original_filename . '"']
        );
    }

    private function findVisa($token): ?VisaApplication
    {
        $visa = VisaApplication::findByToken($token);
        if (!$visa) {
            $visa = VisaApplication::where('unique_token', $token)->first();
        }
        return $visa;
    }
}

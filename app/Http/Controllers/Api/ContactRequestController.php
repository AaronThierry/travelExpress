<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    /**
     * Store a new contact request (public endpoint)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            'destination' => 'required|string|in:china,spain,germany,other',
            'project_type' => 'required|string|in:etudes,travail,business,autre',
            'project_details' => 'nullable|string|max:500',
            'message' => 'nullable|string|max:2000',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email n\'est pas valide.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'destination.required' => 'La destination est requise.',
            'destination.in' => 'Destination non valide.',
            'project_type.required' => 'Le type de projet est requis.',
            'project_type.in' => 'Type de projet non valide.',
        ]);

        $contactRequest = ContactRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'] ?? null,
            'destination' => $validated['destination'],
            'project_type' => $validated['project_type'],
            'project_details' => $validated['project_details'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => ContactRequest::STATUS_NEW,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande a été envoyée avec succès! Nous vous contacterons très bientôt.',
            'data' => [
                'id' => $contactRequest->id,
            ]
        ], 201);
    }
}

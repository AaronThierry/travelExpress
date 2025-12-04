<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Get all approved testimonials
     */
    public function index()
    {
        $testimonials = Testimonial::with('user')
            ->where('is_approved', true)
            ->latest()
            ->get()
            ->map(function ($testimonial) {
                return [
                    'id' => $testimonial->id,
                    'content' => $testimonial->content,
                    'destination' => $testimonial->destination,
                    'rating' => $testimonial->rating,
                    'user' => [
                        'name' => $testimonial->user->name,
                        'country' => $testimonial->user->country,
                        'position' => $testimonial->user->position,
                    ],
                    'created_at' => $testimonial->created_at->format('d M Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $testimonials
        ], 200);
    }

    /**
     * Store a new testimonial (requires authentication)
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:20|max:500',
            'destination' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'content.required' => 'Le contenu du témoignage est requis.',
            'content.min' => 'Le témoignage doit contenir au moins 20 caractères.',
            'content.max' => 'Le témoignage ne peut pas dépasser 500 caractères.',
            'rating.required' => 'La note est requise.',
            'rating.min' => 'La note doit être entre 1 et 5.',
            'rating.max' => 'La note doit être entre 1 et 5.',
        ]);

        $testimonial = Testimonial::create([
            'user_id' => $request->user()->id,
            'content' => $request->content,
            'destination' => $request->destination,
            'rating' => $request->rating,
            'is_approved' => false, // Requires admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre témoignage! Il sera visible après validation.',
            'data' => $testimonial
        ], 201);
    }

    /**
     * Get user's own testimonials
     */
    public function myTestimonials(Request $request)
    {
        $testimonials = Testimonial::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $testimonials
        ], 200);
    }
}

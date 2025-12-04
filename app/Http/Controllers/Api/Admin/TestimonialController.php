<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Get all testimonials (including pending)
     */
    public function index()
    {
        $testimonials = Testimonial::with('user')
            ->latest()
            ->get()
            ->map(function ($testimonial) {
                return [
                    'id' => $testimonial->id,
                    'content' => $testimonial->content,
                    'destination' => $testimonial->destination,
                    'rating' => $testimonial->rating,
                    'is_approved' => $testimonial->is_approved,
                    'user' => [
                        'name' => $testimonial->user->name,
                        'email' => $testimonial->user->email,
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
     * Get pending testimonials only
     */
    public function pending()
    {
        $testimonials = Testimonial::with('user')
            ->where('is_approved', false)
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
                        'email' => $testimonial->user->email,
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
     * Approve a testimonial
     */
    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_approved = true;
        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Témoignage approuvé avec succès!',
            'data' => $testimonial
        ], 200);
    }

    /**
     * Reject (delete) a testimonial
     */
    public function reject($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Témoignage rejeté et supprimé avec succès!'
        ], 200);
    }

    /**
     * Unapprove a testimonial
     */
    public function unapprove($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_approved = false;
        $testimonial->save();

        return response()->json([
            'success' => true,
            'message' => 'Témoignage désapprouvé avec succès!',
            'data' => $testimonial
        ], 200);
    }
}

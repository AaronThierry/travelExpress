<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Get all evaluations (admin).
     */
    public function index(Request $request)
    {
        $query = Evaluation::with('user:id,name,email,avatar')
            ->orderByDesc('created_at');

        // Filter by verification status
        if ($request->has('verified')) {
            $query->where('is_verified', $request->boolean('verified'));
        }

        // Filter by featured
        if ($request->has('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // Filter by discovery source
        if ($request->filled('discovery_source')) {
            $query->where('discovery_source', $request->discovery_source);
        }

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country_of_study', $request->country);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('university', 'like', "%{$search}%");
            });
        }

        $evaluations = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $evaluations,
        ]);
    }

    /**
     * Get pending (unverified) evaluations.
     */
    public function pending(Request $request)
    {
        $evaluations = Evaluation::with('user:id,name,email,avatar')
            ->where('is_verified', false)
            ->orderByDesc('created_at')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $evaluations,
        ]);
    }

    /**
     * Get a single evaluation.
     */
    public function show($id)
    {
        $evaluation = Evaluation::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $evaluation,
        ]);
    }

    /**
     * Verify an evaluation.
     */
    public function verify($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Évaluation vérifiée avec succès.',
            'data' => $evaluation,
        ]);
    }

    /**
     * Unverify an evaluation.
     */
    public function unverify($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update([
            'is_verified' => false,
            'verified_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Vérification annulée.',
            'data' => $evaluation,
        ]);
    }

    /**
     * Toggle featured status.
     */
    public function toggleFeatured($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->update([
            'is_featured' => !$evaluation->is_featured,
        ]);

        return response()->json([
            'success' => true,
            'message' => $evaluation->is_featured ? 'Évaluation mise en avant.' : 'Évaluation retirée de la mise en avant.',
            'data' => $evaluation,
        ]);
    }

    /**
     * Delete an evaluation.
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);

        // Delete photo if exists
        if ($evaluation->photo) {
            \Storage::disk('public')->delete($evaluation->photo);
        }

        $evaluation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Évaluation supprimée.',
        ]);
    }

    /**
     * Get evaluation statistics for admin dashboard.
     */
    public function stats()
    {
        $stats = [
            'total' => Evaluation::count(),
            'pending' => Evaluation::where('is_verified', false)->count(),
            'verified' => Evaluation::verified()->count(),
            'featured' => Evaluation::featured()->count(),
            'average_rating' => round(Evaluation::avg('rating'), 1) ?: 0,
            'would_recommend_count' => Evaluation::where('would_recommend', true)->count(),
            'by_discovery_source' => Evaluation::selectRaw('discovery_source, COUNT(*) as count')
                ->groupBy('discovery_source')
                ->orderByDesc('count')
                ->get(),
            'by_country' => Evaluation::selectRaw('country_of_study, COUNT(*) as count')
                ->groupBy('country_of_study')
                ->orderByDesc('count')
                ->limit(10)
                ->get(),
            'by_study_level' => Evaluation::selectRaw('study_level, COUNT(*) as count')
                ->groupBy('study_level')
                ->orderByDesc('count')
                ->get(),
            'recent' => Evaluation::latest()->limit(5)->get(['id', 'first_name', 'last_name', 'rating', 'created_at']),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}

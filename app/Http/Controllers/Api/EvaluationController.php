<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EvaluationController extends Controller
{
    /**
     * Get public evaluations (for display on website).
     */
    public function index(Request $request)
    {
        $evaluations = Evaluation::public()
            ->with('user:id,name,avatar')
            ->select([
                'id', 'user_id', 'first_name', 'last_name', 'photo',
                'university', 'country_of_study', 'study_level', 'field_of_study',
                'rating', 'public_testimonial', 'allow_photo_display',
                'is_featured', 'created_at'
            ])
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at')
            ->limit($request->get('limit', 10))
            ->get();

        return response()->json([
            'success' => true,
            'data' => $evaluations,
        ]);
    }

    /**
     * Store a new evaluation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

            'university' => 'required|string|max:255',
            'country_of_study' => 'required|string|max:100',
            'study_level' => ['required', Rule::in([
                'licence_1', 'licence_2', 'licence_3',
                'master_1', 'master_2',
                'doctorat', 'formation_professionnelle', 'autre'
            ])],
            'field_of_study' => 'required|string|max:255',
            'start_year' => 'nullable|integer|min:2000|max:' . (date('Y') + 2),

            'service_used' => ['nullable', Rule::in([
                'etudes', 'business', 'tourisme', 'visa_seul', 'autre'
            ])],
            'project_story' => 'required|string|min:50|max:2000',

            'discovery_source' => ['required', Rule::in([
                'ambassadeur_la_bobolaise', 'ambassadeur_ley_ley', 'ambassadeur_autre',
                'facebook', 'tiktok', 'instagram', 'youtube',
                'bouche_a_oreille', 'site_web', 'evenement', 'autre'
            ])],
            'discovery_source_detail' => 'nullable|string|max:255',

            'rating' => 'required|integer|min:1|max:5',
            'rating_accompagnement' => 'nullable|integer|min:1|max:5',
            'rating_communication' => 'nullable|integer|min:1|max:5',
            'rating_delais' => 'nullable|integer|min:1|max:5',
            'rating_rapport_qualite_prix' => 'nullable|integer|min:1|max:5',

            'would_recommend' => 'boolean',
            'comment' => 'nullable|string|max:2000',

            'public_testimonial' => 'nullable|string|max:1000',
            'allow_public_display' => 'boolean',
            'allow_photo_display' => 'boolean',

            'signature' => 'required|string', // Base64 signature data
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('evaluations', 'public');
            $validated['photo'] = $path;
        }

        // Link to user if authenticated
        if (auth('sanctum')->check()) {
            $validated['user_id'] = auth('sanctum')->id();
        }

        // Set defaults
        $validated['would_recommend'] = $validated['would_recommend'] ?? true;
        $validated['allow_public_display'] = $validated['allow_public_display'] ?? false;
        $validated['allow_photo_display'] = $validated['allow_photo_display'] ?? false;
        $validated['service_used'] = $validated['service_used'] ?? 'etudes';

        // Set signed_at timestamp if signature provided
        if (!empty($validated['signature'])) {
            $validated['signed_at'] = now();
        }

        $evaluation = Evaluation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre évaluation ! Elle sera vérifiée par notre équipe.',
            'data' => $evaluation,
        ], 201);
    }

    /**
     * Get user's own evaluation (if authenticated).
     */
    public function myEvaluation(Request $request)
    {
        $evaluation = Evaluation::where('user_id', $request->user()->id)
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'data' => $evaluation,
        ]);
    }

    /**
     * Get evaluation statistics.
     */
    public function stats()
    {
        $stats = [
            'total' => Evaluation::count(),
            'verified' => Evaluation::verified()->count(),
            'average_rating' => round(Evaluation::verified()->avg('rating'), 1) ?: 0,
            'would_recommend_percentage' => Evaluation::verified()->where('would_recommend', true)->count() > 0
                ? round((Evaluation::verified()->where('would_recommend', true)->count() / max(Evaluation::verified()->count(), 1)) * 100)
                : 0,
            'by_discovery_source' => Evaluation::verified()
                ->selectRaw('discovery_source, COUNT(*) as count')
                ->groupBy('discovery_source')
                ->pluck('count', 'discovery_source'),
            'by_country' => Evaluation::verified()
                ->selectRaw('country_of_study, COUNT(*) as count')
                ->groupBy('country_of_study')
                ->orderByDesc('count')
                ->limit(10)
                ->pluck('count', 'country_of_study'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EvaluationController extends Controller
{
    /**
     * Get the actual columns of evaluations table.
     */
    private function getTableColumns(): array
    {
        static $columns = null;
        if ($columns === null) {
            $columns = Schema::getColumnListing('evaluations');
        }
        return $columns;
    }

    /**
     * Check if discovery_source ENUM includes 'siao' value.
     * Returns true only if we're certain 'siao' is supported.
     */
    private function doesEnumSupportSiao(): bool
    {
        try {
            $driver = DB::connection()->getDriverName();

            if ($driver === 'mysql') {
                $column = DB::selectOne("SHOW COLUMNS FROM evaluations WHERE Field = 'discovery_source'");
                if ($column && str_starts_with($column->Type, 'enum')) {
                    // Check if 'siao' is in the enum values
                    return str_contains($column->Type, "'siao'");
                }
                // Not an enum, assume VARCHAR supports any value
                return true;
            }

            // For other databases, assume they support any value
            return true;
        } catch (\Exception $e) {
            // If check fails, assume 'siao' is NOT supported (safe fallback)
            return false;
        }
    }
    /**
     * Get public evaluations (for display on website).
     */
    public function index(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            \Log::error('Evaluations index error: ' . $e->getMessage());

            return response()->json([
                'success' => true,
                'data' => [],
            ]);
        }
    }

    /**
     * Store a new evaluation.
     */
    public function store(Request $request)
    {
        try {
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
                'project_story' => 'required|string|min:50|max:5000',

                'discovery_source' => ['required', Rule::in([
                    'siao', 'ambassadeur_la_bobolaise', 'ambassadeur_ley_ley', 'ambassadeur_autre',
                    'facebook', 'tiktok', 'instagram', 'youtube',
                    'bouche_a_oreille', 'site_web', 'evenement', 'autre'
                ])],
                'discovery_source_detail' => 'nullable|string|max:255',
                'ambassador_direct_contact' => 'nullable',
                'conversation_screenshots' => 'nullable|array|max:5',
                'conversation_screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

                'rating' => 'required|integer|min:1|max:5',
                'rating_accompagnement' => 'nullable|integer|min:1|max:5',
                'rating_communication' => 'nullable|integer|min:1|max:5',
                'rating_delais' => 'nullable|integer|min:1|max:5',
                'rating_rapport_qualite_prix' => 'nullable|integer|min:1|max:5',

                'would_recommend' => 'nullable',
                'comment' => 'nullable|string|max:2000',

                'public_testimonial' => 'nullable|string|max:1000',
                'allow_public_display' => 'nullable',
                'allow_photo_display' => 'nullable',

                'signature' => 'nullable|string',
            ], [
                'first_name.required' => 'Le prénom est obligatoire.',
                'last_name.required' => 'Le nom est obligatoire.',
                'email.required' => 'L\'adresse email est obligatoire.',
                'email.email' => 'L\'adresse email n\'est pas valide.',
                'university.required' => 'Le nom de l\'université est obligatoire.',
                'country_of_study.required' => 'Le pays d\'études est obligatoire.',
                'study_level.required' => 'Le niveau d\'études est obligatoire.',
                'study_level.in' => 'Le niveau d\'études sélectionné n\'est pas valide.',
                'field_of_study.required' => 'La filière d\'études est obligatoire.',
                'project_story.required' => 'Veuillez raconter votre parcours.',
                'project_story.min' => 'Votre récit doit contenir au moins 50 caractères.',
                'discovery_source.required' => 'Veuillez indiquer comment vous avez connu Travel Express.',
                'discovery_source.in' => 'La source de découverte sélectionnée n\'est pas valide.',
                'rating.required' => 'La note globale est obligatoire.',
                'rating.min' => 'La note doit être au minimum 1.',
                'rating.max' => 'La note doit être au maximum 5.',
                'signature.required' => 'Votre signature est obligatoire.',
                'conversation_screenshots.*.image' => 'Les captures d\'écran doivent être des images.',
                'conversation_screenshots.*.max' => 'Chaque capture d\'écran ne doit pas dépasser 5 Mo.',
                'conversation_screenshots.max' => 'Vous ne pouvez pas télécharger plus de 5 captures.',
            ]);

            // Check if signature is required (only if column exists in DB)
            $tableColumns = $this->getTableColumns();
            if (in_array('signature', $tableColumns) && empty($validated['signature'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur de validation.',
                    'errors' => ['signature' => ['Votre signature est obligatoire.']],
                ], 422);
            }

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('evaluations', 'public');
                $validated['photo'] = $path;
            }

            // Handle conversation screenshots upload
            if ($request->hasFile('conversation_screenshots')) {
                $screenshots = [];
                foreach ($request->file('conversation_screenshots') as $screenshot) {
                    if ($screenshot && $screenshot->isValid()) {
                        $path = $screenshot->store('evaluations/screenshots', 'public');
                        $screenshots[] = $path;
                    }
                }
                $validated['conversation_screenshots'] = $screenshots;
            }

            // Link to user if authenticated
            if (auth('sanctum')->check()) {
                $validated['user_id'] = auth('sanctum')->id();
            }

            // Convert string boolean values
            $validated['would_recommend'] = filter_var($validated['would_recommend'] ?? true, FILTER_VALIDATE_BOOLEAN);
            $validated['allow_public_display'] = filter_var($validated['allow_public_display'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $validated['allow_photo_display'] = filter_var($validated['allow_photo_display'] ?? false, FILTER_VALIDATE_BOOLEAN);
            $validated['ambassador_direct_contact'] = isset($validated['ambassador_direct_contact'])
                ? filter_var($validated['ambassador_direct_contact'], FILTER_VALIDATE_BOOLEAN)
                : null;

            // Set defaults
            $validated['service_used'] = $validated['service_used'] ?? 'etudes';

            // Get actual table columns to handle missing migrations
            $tableColumns = $this->getTableColumns();

            // Handle signature fields - only if columns exist
            if (in_array('signature', $tableColumns)) {
                if (!empty($validated['signature']) && in_array('signed_at', $tableColumns)) {
                    $validated['signed_at'] = now();
                }
            } else {
                // Remove signature fields if columns don't exist
                unset($validated['signature']);
                unset($validated['signed_at']);
            }

            // Handle ambassador fields - only if columns exist
            if (!in_array('ambassador_direct_contact', $tableColumns)) {
                unset($validated['ambassador_direct_contact']);
            }
            if (!in_array('conversation_screenshots', $tableColumns)) {
                unset($validated['conversation_screenshots']);
            }

            // Handle discovery_source ENUM compatibility
            // If 'siao' is selected but DB doesn't support it, map to 'evenement'
            if (isset($validated['discovery_source']) && $validated['discovery_source'] === 'siao') {
                if (!$this->doesEnumSupportSiao()) {
                    // SIAO is a salon/event, so map to 'evenement'
                    $validated['discovery_source'] = 'evenement';
                    // Store the original value in detail field
                    $validated['discovery_source_detail'] = 'SIAO - ' . ($validated['discovery_source_detail'] ?? '');
                }
            }

            $evaluation = Evaluation::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Merci pour votre évaluation ! Elle sera vérifiée par notre équipe.',
                'data' => $evaluation,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Evaluation submission error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->except(['signature', 'conversation_screenshots'])
            ]);

            // Return more details in development, generic message in production
            $errorMessage = config('app.debug')
                ? 'Erreur: ' . $e->getMessage()
                : 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.';

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
            ], 500);
        }
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

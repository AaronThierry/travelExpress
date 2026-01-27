<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudentApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_token',
        'access_token',
        'token_expires_at',
        'student_submitted_at',
        'program_type',
        'student_name',
        'student_email',
        'student_phone',
        'passport_number',
        'dossier_type',
        'visa_current',
        'casier_judiciaire_valide',
        'bilan_sante_chinois_path',
        'complement_application',
        'numero_chinois',
        'complementary_status',
        'complementary_submitted_at',
        'current_step',
        'university_name',
        'field_of_study',
        'admission_year',
        'status',
        'admin_notes',
        'submitted_at',
        'reviewed_at',
        'reviewed_by'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'complementary_submitted_at' => 'datetime',
        'student_submitted_at' => 'datetime',
        'token_expires_at' => 'datetime',
        'casier_judiciaire_valide' => 'boolean',
        'current_step' => 'integer',
        'admission_year' => 'integer',
    ];

    // Constantes pour les types de dossier
    const TYPE_NOUVEAU = 'nouveau';
    const TYPE_COMPLEMENTAIRE = 'complementaire';

    // Constantes pour les statuts complémentaires
    const COMP_STATUS_NOT_STARTED = 'not_started';
    const COMP_STATUS_IN_PROGRESS = 'in_progress';
    const COMP_STATUS_SUBMITTED = 'submitted';
    const COMP_STATUS_APPROVED = 'approved';
    const COMP_STATUS_REJECTED = 'rejected';

    // Documents requis pour le dossier initial (nouveau)
    public static function getRequiredDocuments(string $programType): array
    {
        $license = [
            'photo_identite' => 'Photo d\'identité (35mm x 45mm)',
            'passeport' => 'Passeport (page d\'information)',
            'diplomes_bac' => 'Diplômes et relevés de note du BAC',
            'casier_judiciaire' => 'Casier judiciaire valable',
            'visite_medicale' => 'Visite médicale (optionnel)',
            'formulaire_candidature' => 'Formulaire de candidature',
            'carte_identite_parent' => 'Copie carte d\'identité du père ou de la mère'
        ];

        $master = [
            'photo_identite' => 'Photo d\'identité (35mm x 45mm)',
            'passeport' => 'Passeport (page d\'information)',
            'bulletin_license' => 'Bulletin de la License',
            'diplomes_license' => 'Diplômes de License',
            'casier_judiciaire' => 'Casier judiciaire valable',
            'visite_medicale' => 'Visite médicale (optionnel)',
            'test_anglais' => 'Test d\'Anglais (optionnel)',
            'formulaire_candidature' => 'Formulaire de candidature',
            'plan_etude' => 'Plan d\'étude',
            'lettres_motivation' => 'Deux lettres de motivation'
        ];

        return $programType === 'master' ? $master : $license;
    }

    // Documents requis pour le dossier complémentaire
    public static function getComplementaryDocuments(): array
    {
        return [
            'visa_chinois' => 'Visa chinois actuel',
            'bilan_sante_chinois' => 'Bilan de santé format chinois',
            'casier_judiciaire_traduit' => 'Casier judiciaire traduit en chinois',
            'attestation_hebergement' => 'Attestation d\'hébergement (optionnel)',
            'justificatif_ressources' => 'Justificatif de ressources financières (optionnel)',
        ];
    }

    // Relationships
    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class, 'application_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Generate unique token
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            if (empty($application->unique_token)) {
                $application->unique_token = Str::random(32);
            }
        });
    }

    // Get upload link for student
    public function getUploadLinkAttribute(): string
    {
        return url("/student/upload/{$this->unique_token}");
    }

    // Check if initial application is complete
    public function getIsCompleteAttribute(): bool
    {
        $requiredDocs = self::getRequiredDocuments($this->program_type);
        $uploadedDocs = $this->documents()->pluck('document_type')->toArray();

        foreach (array_keys($requiredDocs) as $docType) {
            // Skip optional documents
            if (in_array($docType, ['visite_medicale', 'test_anglais'])) {
                continue;
            }
            if (!in_array($docType, $uploadedDocs)) {
                return false;
            }
        }

        return true;
    }

    // Get completion percentage for initial dossier
    public function getCompletionPercentageAttribute(): int
    {
        $requiredDocs = self::getRequiredDocuments($this->program_type);
        // Remove optional documents from calculation
        $requiredDocs = array_filter($requiredDocs, function($key) {
            return !in_array($key, ['visite_medicale', 'test_anglais']);
        }, ARRAY_FILTER_USE_KEY);

        $uploadedDocs = $this->documents()->pluck('document_type')->toArray();
        $uploadedCount = count(array_intersect(array_keys($requiredDocs), $uploadedDocs));

        return (int) (($uploadedCount / count($requiredDocs)) * 100);
    }

    // Check if complementary dossier is complete
    public function getIsComplementaryCompleteAttribute(): bool
    {
        // Check required fields
        if (empty($this->visa_current)) return false;
        if (!$this->casier_judiciaire_valide) return false;
        if (empty($this->bilan_sante_chinois_path)) return false;
        if (empty($this->numero_chinois)) return false;

        // Check required complementary documents
        $compDocs = self::getComplementaryDocuments();
        $uploadedDocs = $this->documents()->pluck('document_type')->toArray();

        foreach (array_keys($compDocs) as $docType) {
            // Skip optional documents
            if (in_array($docType, ['attestation_hebergement', 'justificatif_ressources'])) {
                continue;
            }
            if (!in_array($docType, $uploadedDocs)) {
                return false;
            }
        }

        return true;
    }

    // Get completion percentage for complementary dossier
    public function getComplementaryCompletionPercentageAttribute(): int
    {
        $total = 5; // visa_current, casier_judiciaire_valide, bilan_sante_chinois, numero_chinois + required docs
        $completed = 0;

        if (!empty($this->visa_current)) $completed++;
        if ($this->casier_judiciaire_valide) $completed++;
        if (!empty($this->bilan_sante_chinois_path)) $completed++;
        if (!empty($this->numero_chinois)) $completed++;

        // Add required complementary documents
        $compDocs = self::getComplementaryDocuments();
        $requiredCompDocs = array_filter($compDocs, function($key) {
            return !in_array($key, ['attestation_hebergement', 'justificatif_ressources']);
        }, ARRAY_FILTER_USE_KEY);

        $total += count($requiredCompDocs);
        $uploadedDocs = $this->documents()->pluck('document_type')->toArray();
        $completed += count(array_intersect(array_keys($requiredCompDocs), $uploadedDocs));

        return $total > 0 ? (int) (($completed / $total) * 100) : 0;
    }

    // Get overall completion percentage (both dossiers combined)
    public function getOverallCompletionPercentageAttribute(): int
    {
        $initialCompletion = $this->completion_percentage;
        $compCompletion = $this->complementary_completion_percentage;

        // Initial dossier counts as 60%, complementary as 40%
        return (int) (($initialCompletion * 0.6) + ($compCompletion * 0.4));
    }

    // Get current step label
    public function getCurrentStepLabelAttribute(): string
    {
        return match($this->current_step) {
            1 => 'Dossier Initial',
            2 => 'Dossier Complémentaire',
            3 => 'Finalisation',
            default => 'En attente',
        };
    }

    // Get status label with color
    public function getStatusInfoAttribute(): array
    {
        return match($this->status) {
            'pending' => ['label' => 'En attente', 'color' => 'yellow', 'icon' => 'clock'],
            'incomplete' => ['label' => 'Incomplet', 'color' => 'orange', 'icon' => 'exclamation'],
            'complete' => ['label' => 'Complet', 'color' => 'blue', 'icon' => 'check'],
            'approved' => ['label' => 'Approuvé', 'color' => 'green', 'icon' => 'check-circle'],
            'rejected' => ['label' => 'Rejeté', 'color' => 'red', 'icon' => 'x-circle'],
            default => ['label' => $this->status, 'color' => 'gray', 'icon' => 'question'],
        };
    }

    // Get complementary status info
    public function getComplementaryStatusInfoAttribute(): array
    {
        return match($this->complementary_status) {
            'not_started' => ['label' => 'Non démarré', 'color' => 'gray', 'icon' => 'minus'],
            'in_progress' => ['label' => 'En cours', 'color' => 'blue', 'icon' => 'refresh'],
            'submitted' => ['label' => 'Soumis', 'color' => 'yellow', 'icon' => 'clock'],
            'approved' => ['label' => 'Approuvé', 'color' => 'green', 'icon' => 'check-circle'],
            'rejected' => ['label' => 'Rejeté', 'color' => 'red', 'icon' => 'x-circle'],
            default => ['label' => $this->complementary_status ?? 'Non démarré', 'color' => 'gray', 'icon' => 'question'],
        };
    }

    // Scope for filtering by dossier type
    public function scopeNouveau($query)
    {
        return $query->where('dossier_type', self::TYPE_NOUVEAU);
    }

    public function scopeComplementaire($query)
    {
        return $query->where('dossier_type', self::TYPE_COMPLEMENTAIRE);
    }

    // Scope for filtering by complementary status
    public function scopeComplementaryStatus($query, $status)
    {
        return $query->where('complementary_status', $status);
    }

    // Check if student has both dossier types
    public function getHasComplementaryDataAttribute(): bool
    {
        return $this->complementary_status !== self::COMP_STATUS_NOT_STARTED
            || !empty($this->visa_current)
            || !empty($this->numero_chinois)
            || !empty($this->bilan_sante_chinois_path);
    }

    // Generate new access token for student
    public function generateAccessToken(int $expiresInDays = 30): string
    {
        $this->access_token = Str::random(64);
        $this->token_expires_at = now()->addDays($expiresInDays);
        $this->save();

        return $this->access_token;
    }

    // Check if access token is valid
    public function isTokenValid(): bool
    {
        if (empty($this->access_token)) {
            return false;
        }

        if ($this->token_expires_at && $this->token_expires_at->isPast()) {
            return false;
        }

        return true;
    }

    // Get public form URL for student
    public function getStudentFormUrlAttribute(): ?string
    {
        if (empty($this->access_token)) {
            return null;
        }

        return url("/dossier/{$this->access_token}");
    }

    // Find application by access token
    public static function findByToken(string $token): ?self
    {
        return static::where('access_token', $token)
            ->where(function ($query) {
                $query->whereNull('token_expires_at')
                    ->orWhere('token_expires_at', '>', now());
            })
            ->first();
    }

    // Scope for applications with valid tokens
    public function scopeWithValidToken($query)
    {
        return $query->whereNotNull('access_token')
            ->where(function ($q) {
                $q->whereNull('token_expires_at')
                    ->orWhere('token_expires_at', '>', now());
            });
    }

    // Mark as submitted by student
    public function markAsSubmittedByStudent(): void
    {
        $this->student_submitted_at = now();
        $this->status = 'pending';
        $this->save();
    }
}

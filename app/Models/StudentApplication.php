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
        'program_type',
        'student_name',
        'student_email',
        'student_phone',
        'passport_number',
        'status',
        'admin_notes',
        'submitted_at',
        'reviewed_at',
        'reviewed_by'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    // Required documents by program type
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

    // Check if application is complete
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

    // Get completion percentage
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VisaApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_token',
        'access_token',
        'token_expires_at',
        'student_name',
        'student_email',
        'student_phone',
        'passport_number',
        'status',
        'admin_notes',
        'submitted_at',
        'student_submitted_at',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'token_expires_at'      => 'datetime',
        'submitted_at'          => 'datetime',
        'student_submitted_at'  => 'datetime',
        'reviewed_at'           => 'datetime',
    ];

    // Documents requis pour le dossier visa
    const DOCUMENTS = [
        'releve_bancaire'            => 'Relevé bancaire',
        'certificat_prise_en_charge' => 'Certificat de prise en charge',
        'copie_legalisee_garant'     => 'Copie légalisée du garant financier',
        'autorisation_parentale'     => 'Autorisation parentale (optionnel)',
    ];

    const OPTIONAL_DOCUMENTS = ['autorisation_parentale'];

    // ─── Boot ────────────────────────────────────────────────────────────────

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($visa) {
            if (empty($visa->unique_token)) {
                $visa->unique_token = Str::random(32);
            }
        });
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function documents()
    {
        return $this->hasMany(VisaDocument::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // ─── Token helpers ────────────────────────────────────────────────────────

    public function generateAccessToken(int $expiresInDays = 30): string
    {
        $this->access_token     = Str::random(64);
        $this->token_expires_at = now()->addDays($expiresInDays);
        $this->save();

        return $this->access_token;
    }

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

    public static function findByToken(string $token): ?self
    {
        return static::where('access_token', $token)
            ->where(function ($q) {
                $q->whereNull('token_expires_at')
                  ->orWhere('token_expires_at', '>', now());
            })
            ->first();
    }

    public function getStudentFormUrlAttribute(): ?string
    {
        if (empty($this->access_token)) return null;
        return url("/visa/{$this->access_token}");
    }

    // ─── Computed attributes ──────────────────────────────────────────────────

    public function getCompletionPercentageAttribute(): int
    {
        $required = array_diff(array_keys(self::DOCUMENTS), self::OPTIONAL_DOCUMENTS);
        $uploaded = $this->documents()->pluck('document_type')->toArray();
        $done     = count(array_intersect($required, $uploaded));
        return count($required) > 0 ? (int)(($done / count($required)) * 100) : 0;
    }

    public function getIsCompleteAttribute(): bool
    {
        $required = array_diff(array_keys(self::DOCUMENTS), self::OPTIONAL_DOCUMENTS);
        $uploaded = $this->documents()->pluck('document_type')->toArray();
        foreach ($required as $docType) {
            if (!in_array($docType, $uploaded)) return false;
        }
        return true;
    }

    public function getStatusInfoAttribute(): array
    {
        return match ($this->status) {
            'pending'     => ['label' => 'En attente',  'color' => 'yellow'],
            'in_progress' => ['label' => 'En cours',    'color' => 'blue'],
            'complete'    => ['label' => 'Complet',     'color' => 'blue'],
            'approved'    => ['label' => 'Approuvé',    'color' => 'green'],
            'rejected'    => ['label' => 'Rejeté',      'color' => 'red'],
            default       => ['label' => $this->status, 'color' => 'gray'],
        };
    }
}

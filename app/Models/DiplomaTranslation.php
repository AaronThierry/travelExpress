<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DiplomaTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_application_id',
        'document_type',
        'source_scan_path',
        'ocr_raw_text',
        'extracted_fields',
        'verified_fields',
        'status',
        'generated_pdf_path',
        'certified_pdf_path',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'extracted_fields' => 'array',
        'verified_fields'  => 'array',
        'reviewed_at'      => 'datetime',
    ];

    // Statuts du pipeline (upload -> OCR -> relecture -> génération -> certification)
    const STATUS_PENDING_OCR    = 'pending_ocr';
    const STATUS_PENDING_REVIEW = 'pending_review';
    const STATUS_REVIEWED       = 'reviewed';
    const STATUS_GENERATED      = 'generated';
    const STATUS_SENT_PARTNER   = 'sent_partner';
    const STATUS_CERTIFIED      = 'certified';

    // Champs attendus pour un baccalauréat (Burkina Faso) — la source de vérité
    // pour les formulaires de relecture et les règles d'extraction OCR.
    const BAC_FIELDS = [
        'nom_complet'     => 'Nom et prénom(s)',
        'date_naissance'  => 'Date de naissance',
        'lieu_naissance'  => 'Lieu de naissance',
        'serie'           => 'Série',
        'session'         => 'Session',
        'mention'         => 'Mention',
        'moyenne'         => 'Moyenne',
        'numero_diplome'  => 'Numéro du diplôme',
    ];

    // Relationships
    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Champs à utiliser pour générer le document : la version vérifiée par le
    // staff prime toujours sur l'extraction automatique brute.
    public function getFieldsForGenerationAttribute(): array
    {
        return array_merge(
            array_fill_keys(array_keys(self::BAC_FIELDS), null),
            $this->extracted_fields ?? [],
            $this->verified_fields ?? []
        );
    }

    public function getSourceScanUrlAttribute(): ?string
    {
        return $this->source_scan_path ? Storage::url($this->source_scan_path) : null;
    }

    public function getGeneratedPdfUrlAttribute(): ?string
    {
        return $this->generated_pdf_path ? Storage::url($this->generated_pdf_path) : null;
    }

    public function getCertifiedPdfUrlAttribute(): ?string
    {
        return $this->certified_pdf_path ? Storage::url($this->certified_pdf_path) : null;
    }

    public function markReviewed(User $user, array $verifiedFields): void
    {
        $this->verified_fields = $verifiedFields;
        $this->reviewed_by = $user->id;
        $this->reviewed_at = now();
        $this->status = self::STATUS_REVIEWED;
        $this->save();
    }

    // Supprime les fichiers associés quand l'enregistrement est supprimé
    protected static function boot()
    {
        parent::boot();

        static::deleting(function (DiplomaTranslation $diploma) {
            foreach ([$diploma->source_scan_path, $diploma->generated_pdf_path, $diploma->certified_pdf_path] as $path) {
                if ($path && Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
        });
    }
}

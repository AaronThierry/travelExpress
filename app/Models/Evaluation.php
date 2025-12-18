<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'photo',
        'university',
        'country_of_study',
        'study_level',
        'field_of_study',
        'start_year',
        'service_used',
        'project_story',
        'discovery_source',
        'discovery_source_detail',
        'rating',
        'rating_accompagnement',
        'rating_communication',
        'rating_delais',
        'rating_rapport_qualite_prix',
        'would_recommend',
        'comment',
        'public_testimonial',
        'allow_public_display',
        'allow_photo_display',
        'is_verified',
        'is_featured',
        'verified_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'rating_accompagnement' => 'integer',
        'rating_communication' => 'integer',
        'rating_delais' => 'integer',
        'rating_rapport_qualite_prix' => 'integer',
        'would_recommend' => 'boolean',
        'allow_public_display' => 'boolean',
        'allow_photo_display' => 'boolean',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'verified_at' => 'datetime',
        'start_year' => 'integer',
    ];

    /**
     * Get the user that owns the evaluation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the average rating.
     */
    public function getAverageRatingAttribute(): float
    {
        $ratings = array_filter([
            $this->rating,
            $this->rating_accompagnement,
            $this->rating_communication,
            $this->rating_delais,
            $this->rating_rapport_qualite_prix,
        ]);

        return count($ratings) > 0 ? round(array_sum($ratings) / count($ratings), 1) : $this->rating;
    }

    /**
     * Get the study level label.
     */
    public function getStudyLevelLabelAttribute(): string
    {
        return match($this->study_level) {
            'licence_1' => 'Licence 1',
            'licence_2' => 'Licence 2',
            'licence_3' => 'Licence 3',
            'master_1' => 'Master 1',
            'master_2' => 'Master 2',
            'doctorat' => 'Doctorat',
            'formation_professionnelle' => 'Formation professionnelle',
            'autre' => 'Autre',
            default => $this->study_level,
        };
    }

    /**
     * Get the discovery source label.
     */
    public function getDiscoverySourceLabelAttribute(): string
    {
        return match($this->discovery_source) {
            'ambassadeur_la_bobolaise' => 'Ambassadrice - La Bobolaise',
            'ambassadeur_ley_ley' => 'Ambassadeur - Ley Ley',
            'ambassadeur_autre' => 'Autre ambassadeur',
            'facebook' => 'Facebook',
            'tiktok' => 'TikTok',
            'instagram' => 'Instagram',
            'youtube' => 'YouTube',
            'bouche_a_oreille' => 'Bouche à oreille',
            'site_web' => 'Site web',
            'evenement' => 'Événement',
            'autre' => 'Autre',
            default => $this->discovery_source,
        };
    }

    /**
     * Scope verified evaluations.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope featured evaluations.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope public evaluations.
     */
    public function scopePublic($query)
    {
        return $query->where('allow_public_display', true)->verified();
    }
}

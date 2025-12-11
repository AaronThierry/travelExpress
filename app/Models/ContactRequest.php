
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'destination',
        'project_type',
        'project_details',
        'message',
        'status',
        'admin_notes',
        'contacted_at',
        'last_contact_at',
        'assigned_to',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
        'last_contact_at' => 'datetime',
    ];

    // Statuts disponibles
    const STATUS_NEW = 'new';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'Nouveau',
            self::STATUS_CONTACTED => 'Contacté',
            self::STATUS_IN_PROGRESS => 'En cours',
            self::STATUS_COMPLETED => 'Terminé',
            self::STATUS_CANCELLED => 'Annulé',
        ];
    }

    public static function getStatusColors(): array
    {
        return [
            self::STATUS_NEW => 'bg-blue-100 text-blue-800',
            self::STATUS_CONTACTED => 'bg-yellow-100 text-yellow-800',
            self::STATUS_IN_PROGRESS => 'bg-purple-100 text-purple-800',
            self::STATUS_COMPLETED => 'bg-green-100 text-green-800',
            self::STATUS_CANCELLED => 'bg-red-100 text-red-800',
        ];
    }

    public static function getDestinations(): array
    {
        return [
            'china' => '🇨🇳 Chine',
            'spain' => '🇪🇸 Espagne',
            'germany' => '🇩🇪 Allemagne',
            'other' => '🌍 Autre',
        ];
    }

    public static function getProjectTypes(): array
    {
        return [
            'etudes' => '📚 Études',
            'travail' => '💼 Travail',
            'business' => '🏢 Business',
            'autre' => '📋 Autre',
        ];
    }

    // Relations
    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Génère le lien WhatsApp
    public function getWhatsappLink(): string
    {
        // Nettoyer le numéro (garder uniquement les chiffres, l'indicatif est déjà inclus)
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        $projectType = self::getProjectTypes()[$this->project_type] ?? $this->project_type;
        $destination = self::getDestinations()[$this->destination] ?? $this->destination;

        $message = urlencode("Bonjour {$this->name},\n\nMerci pour votre demande concernant votre projet {$projectType} vers {$destination}.\n\nJe suis de Travel Express. Je vous contacte pour discuter de votre projet.\n\nPouvez-vous me donner plus de détails sur vos attentes ?");

        return "https://wa.me/{$phone}?text={$message}";
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', [self::STATUS_NEW, self::STATUS_CONTACTED, self::STATUS_IN_PROGRESS]);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }
}

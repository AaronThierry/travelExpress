<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_complet',
        'whatsapp',
        'email',
        'destination',
        'filiere',
    ];

    public static function getDestinations(): array
    {
        return [
            'Chine'    => '🇨🇳 Chine',
            'Espagne'  => '🇪🇸 Espagne',
            'Allemagne'=> '🇩🇪 Allemagne',
            'France'   => '🇫🇷 France',
            'Canada'   => '🇨🇦 Canada',
            'Autre'    => '🌍 Autre',
        ];
    }

    public static function getFilieres(): array
    {
        return [
            'Informatique/Tech'         => '💻 Informatique / Tech',
            'Commerce/Gestion'          => '📊 Commerce / Gestion',
            'Médecine/Santé'            => '🏥 Médecine / Santé',
            'Droit'                     => '⚖️ Droit',
            'Ingénierie'                => '⚙️ Ingénierie',
            'Lettres/Sciences humaines' => '📚 Lettres / Sciences humaines',
            'Autre'                     => '📋 Autre',
        ];
    }

    public function getWhatsappLink(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp);
        $message = urlencode("Bonjour {$this->nom_complet},\n\nJe vous contacte de la part de Travel Express suite à notre rencontre. Votre projet vers {$this->destination} nous intéresse beaucoup.\n\nPouvez-vous nous donner plus de détails ?");
        return "https://wa.me/{$phone}?text={$message}";
    }
}

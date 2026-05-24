<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistreVoyageur extends Model
{
    protected $table = 'registre_voyageurs';

    protected $fillable = ['nom', 'prenom', 'destination', 'signature_svg', 'signed_at'];

    protected $casts = ['signed_at' => 'datetime'];
}

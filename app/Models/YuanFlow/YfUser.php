<?php

namespace App\Models\YuanFlow;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class YfUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'yf_users';

    protected $fillable = [
        'phone',
        'country_code',
        'email',
        'first_name',
        'last_name',
        'date_of_birth',
        'pin_hash',
        'biometric_enabled',
        'status',
        'kyc_status',
        'kyc_document_type',
        'kyc_document_number',
        'kyc_document_front',
        'kyc_document_back',
        'phone_verified_at',
        'country',
        'avatar_url',
        'is_profile_complete',
    ];

    protected $hidden = ['pin_hash'];

    protected $casts = [
        'phone_verified_at'  => 'datetime',
        'email_verified_at'  => 'datetime',
        'biometric_enabled'  => 'boolean',
        'is_profile_complete'=> 'boolean',
        'date_of_birth'      => 'date',
    ];

    public function wallet()
    {
        return $this->hasOne(YfWallet::class, 'yf_user_id');
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'yf_user_id');
    }

    public function recipients()
    {
        return $this->hasMany(YfRecipient::class, 'yf_user_id');
    }

    public function transactions()
    {
        return $this->hasMany(YfTransaction::class, 'yf_user_id');
    }

    public function notifications()
    {
        return $this->hasMany(YfNotification::class, 'yf_user_id');
    }

    public function verifyPin(string $pin): bool
    {
        return \Hash::check($pin, $this->pin_hash);
    }
}

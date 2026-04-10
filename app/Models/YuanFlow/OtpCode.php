<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    protected $table = 'otp_codes';

    protected $fillable = [
        'phone', 'code', 'type',
        'expires_at', 'verified', 'verified_at', 'attempts',
    ];

    protected $casts = [
        'expires_at'  => 'datetime',
        'verified_at' => 'datetime',
        'verified'    => 'boolean',
    ];

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isValid(): bool
    {
        return !$this->verified && !$this->isExpired() && $this->attempts < 3;
    }
}

<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = 'beneficiaries';

    protected $fillable = [
        'yf_user_id', 'first_name', 'last_name', 'chinese_name',
        'phone', 'country_code', 'bank_name', 'bank_account_number',
        'bank_code', 'city', 'province', 'relationship',
        'is_favorite', 'status',
    ];

    protected $casts = ['is_favorite' => 'boolean'];

    protected $hidden = ['bank_account_number'];

    protected $appends = ['masked_account_number'];

    public function yfUser()
    {
        return $this->belongsTo(YfUser::class, 'yf_user_id');
    }

    public function transactions()
    {
        return $this->hasMany(YfTransaction::class, 'beneficiary_id');
    }

    public function getMaskedAccountNumberAttribute(): string
    {
        $account = $this->bank_account_number;
        return str_repeat('*', max(0, strlen($account) - 4)) . substr($account, -4);
    }
}

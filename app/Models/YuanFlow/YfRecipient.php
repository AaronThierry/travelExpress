<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class YfRecipient extends Model
{
    protected $table = 'yf_recipients';

    protected $fillable = [
        'yf_user_id', 'name', 'payment_method',
        'alipay_id', 'wechat_id', 'bank',
        'is_favorite', 'last_used',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'last_used'   => 'datetime',
    ];

    public function yfUser()
    {
        return $this->belongsTo(YfUser::class, 'yf_user_id');
    }

    public function touchLastUsed(): void
    {
        $this->update(['last_used' => now()]);
    }
}

<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class YfWallet extends Model
{
    protected $table = 'yf_wallets';

    protected $fillable = ['yf_user_id', 'balance_xof', 'balance_cny'];

    protected $casts = [
        'balance_xof' => 'decimal:2',
        'balance_cny' => 'decimal:6',
    ];

    public function yfUser()
    {
        return $this->belongsTo(YfUser::class, 'yf_user_id');
    }

    public function credit(float $amountXof, float $amountCny = 0): void
    {
        $this->increment('balance_xof', $amountXof);
        if ($amountCny > 0) $this->increment('balance_cny', $amountCny);
    }

    public function debit(float $amountXof): bool
    {
        if ($this->balance_xof < $amountXof) return false;
        $this->decrement('balance_xof', $amountXof);
        return true;
    }
}

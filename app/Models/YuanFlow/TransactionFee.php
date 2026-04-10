<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class TransactionFee extends Model
{
    protected $table = 'transaction_fees';

    protected $fillable = [
        'min_amount', 'max_amount', 'fee_type',
        'fixed_fee', 'percentage_fee', 'currency', 'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'min_amount'     => 'decimal:2',
        'max_amount'     => 'decimal:2',
        'fixed_fee'      => 'decimal:2',
        'percentage_fee' => 'decimal:2',
    ];

    public static function calculate(float $amount): float
    {
        $rule = static::where('is_active', true)
            ->where('min_amount', '<=', $amount)
            ->where('max_amount', '>=', $amount)
            ->first();

        if (!$rule) return 0;

        return match ($rule->fee_type) {
            'fixed'      => (float) $rule->fixed_fee,
            'percentage' => round($amount * $rule->percentage_fee / 100, 2),
            'mixed'      => (float) $rule->fixed_fee + round($amount * $rule->percentage_fee / 100, 2),
            default      => 0,
        };
    }
}

<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rates';

    protected $fillable = [
        'from_currency', 'to_currency', 'rate',
        'source', 'valid_from', 'valid_until', 'is_active',
    ];

    protected $casts = [
        'valid_from'  => 'datetime',
        'valid_until' => 'datetime',
        'is_active'   => 'boolean',
        'rate'        => 'decimal:6',
    ];

    public static function current(string $from = 'XOF', string $to = 'CNY'): ?self
    {
        return static::where('from_currency', $from)
            ->where('to_currency', $to)
            ->where('is_active', true)
            ->latest('valid_from')
            ->first();
    }
}

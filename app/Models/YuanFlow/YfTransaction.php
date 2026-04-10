<?php

namespace App\Models\YuanFlow;

use Illuminate\Database\Eloquent\Model;

class YfTransaction extends Model
{
    protected $table = 'yf_transactions';

    protected $fillable = [
        'transaction_ref', 'yf_user_id', 'beneficiary_id',
        'send_amount', 'send_currency',
        'receive_amount', 'receive_currency', 'exchange_rate',
        'transfer_fee', 'total_amount', 'status',
        'payment_method', 'payment_reference', 'payment_completed_at',
        'payout_method', 'payout_reference', 'payout_completed_at',
        'reason', 'notes', 'failed_reason',
    ];

    protected $casts = [
        'payment_completed_at' => 'datetime',
        'payout_completed_at'  => 'datetime',
        'send_amount'          => 'decimal:2',
        'receive_amount'       => 'decimal:2',
        'exchange_rate'        => 'decimal:6',
        'transfer_fee'         => 'decimal:2',
        'total_amount'         => 'decimal:2',
    ];

    public function yfUser()
    {
        return $this->belongsTo(YfUser::class, 'yf_user_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }

    public static function generateRef(): string
    {
        return 'YF' . date('Ymd') . '-' . str_pad(
            static::whereDate('created_at', today())->count() + 1,
            6, '0', STR_PAD_LEFT
        );
    }
}

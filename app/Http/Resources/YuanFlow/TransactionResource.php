<?php

namespace App\Http\Resources\YuanFlow;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'tracking_number'  => $this->transaction_ref,
            'type'             => 'sent',
            'amount_xof'       => (float) $this->send_amount,
            'amount_cny'       => (float) $this->receive_amount,
            'exchange_rate'    => (float) $this->exchange_rate,
            'fee'              => (float) $this->transfer_fee,
            'total_xof'        => (float) $this->total_amount,
            'payment_method'   => $this->payment_method,
            'status'           => $this->status,
            'recipient_name'   => optional($this->whenLoaded('recipient'))->name ?? null,
            'created_at'       => $this->created_at,
            'completed_at'     => $this->payout_completed_at,
        ];
    }
}

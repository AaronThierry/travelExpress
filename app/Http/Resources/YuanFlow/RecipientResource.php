<?php

namespace App\Http\Resources\YuanFlow;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'payment_method' => $this->payment_method,
            'alipay_id'      => $this->alipay_id,
            'wechat_id'      => $this->wechat_id,
            'bank'           => $this->bank,
            'is_favorite'    => $this->is_favorite,
            'last_used'      => $this->last_used,
        ];
    }
}

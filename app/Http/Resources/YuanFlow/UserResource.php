<?php

namespace App\Http\Resources\YuanFlow;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'first_name'          => $this->first_name,
            'last_name'           => $this->last_name,
            'phone'               => $this->phone,
            'email'               => $this->email,
            'country'             => $this->country,
            'avatar_url'          => $this->avatar_url,
            'kyc_status'          => $this->kyc_status,
            'biometric_enabled'   => $this->biometric_enabled,
            'is_profile_complete' => $this->is_profile_complete,
            'status'              => $this->status,
            'phone_verified_at'   => $this->phone_verified_at,
            'created_at'          => $this->created_at,
        ];
    }
}

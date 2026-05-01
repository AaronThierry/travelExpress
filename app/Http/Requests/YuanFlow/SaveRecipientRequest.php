<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class SaveRecipientRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:150',
            'payment_method' => 'required|in:alipay,wechat',
            'alipay_id'      => 'required_if:payment_method,alipay|nullable|string|max:100',
            'wechat_id'      => 'required_if:payment_method,wechat|nullable|string|max:100',
            'bank'           => 'nullable|string|max:100',
        ];
    }
}

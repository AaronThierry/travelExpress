<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class InitiateTransferRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'amount_xof'              => 'required|numeric|min:1000|max:5000000',
            'payment_method'          => 'required|in:alipay,wechat',
            'recipient.name'          => 'required|string|max:150',
            'recipient.alipay_id'     => 'required_if:payment_method,alipay|nullable|string|max:100',
            'recipient.wechat_id'     => 'required_if:payment_method,wechat|nullable|string|max:100',
            'recipient.bank'          => 'nullable|string|max:100',
            'recipient_id'            => 'nullable|integer|exists:yf_recipients,id',
        ];
    }

    public function messages(): array
    {
        return [
            'amount_xof.min'              => 'Le montant minimum est de 1 000 XOF.',
            'amount_xof.max'              => 'Le montant maximum est de 5 000 000 XOF.',
            'recipient.alipay_id.required_if' => 'L\'identifiant Alipay est requis pour ce mode de paiement.',
            'recipient.wechat_id.required_if' => 'L\'identifiant WeChat est requis pour ce mode de paiement.',
        ];
    }
}

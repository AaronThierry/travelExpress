<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class SendOtpRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'type'         => 'required|in:phone,email',
            'value'        => [
                'required', 'string',
                $this->input('type') === 'email' ? 'email' : 'regex:/^\+?[1-9]\d{6,14}$/',
            ],
            'country_code' => 'nullable|string|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'  => 'Le type (phone ou email) est requis.',
            'value.required' => 'Le numéro de téléphone ou l\'email est requis.',
            'value.email'    => 'L\'adresse email n\'est pas valide.',
            'value.regex'    => 'Le numéro de téléphone n\'est pas valide.',
        ];
    }
}

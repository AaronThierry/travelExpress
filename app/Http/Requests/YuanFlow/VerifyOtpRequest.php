<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'type'  => 'required|in:phone,email',
            'value' => 'required|string',
            'otp'   => 'required|string|size:6|regex:/^\d{6}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'otp.size'  => 'Le code OTP doit contenir exactement 6 chiffres.',
            'otp.regex' => 'Le code OTP doit être composé de chiffres uniquement.',
        ];
    }
}

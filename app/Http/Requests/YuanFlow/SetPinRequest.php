<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class SetPinRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'current_pin'      => 'nullable|string|size:4|regex:/^\d{4}$/',
            'pin'              => 'required|string|size:4|regex:/^\d{4}$/',
            'pin_confirmation' => 'required|same:pin',
        ];
    }

    public function messages(): array
    {
        return [
            'pin.size'              => 'Le PIN doit contenir exactement 4 chiffres.',
            'pin.regex'             => 'Le PIN doit être composé de chiffres uniquement.',
            'pin_confirmation.same' => 'Les deux PIN ne correspondent pas.',
        ];
    }
}

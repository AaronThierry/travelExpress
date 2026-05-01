<?php

namespace App\Http\Requests\YuanFlow;

use Illuminate\Foundation\Http\FormRequest;

class CompleteProfileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'nullable|email|unique:yf_users,email,' . $userId,
            'date_of_birth' => 'nullable|date|before:today',
            'country'       => 'nullable|string|size:2',
            'avatar'        => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est requis.',
            'last_name.required'  => 'Le nom est requis.',
            'country.size'        => 'Le code pays doit être en format ISO 2 lettres (ex: BF).',
        ];
    }
}

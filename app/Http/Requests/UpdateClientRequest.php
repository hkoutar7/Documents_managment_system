<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => "required|max:50|string",
            'description'=> 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ du nom est obligatoire.',
            'name.max' => 'Le champ du nom ne doit pas dépasser 50 caractères.',
            'name.string' => 'Le champ du nom doit être une chaîne de caractères.',
            'description.string' => 'Le champ de la description doit être une chaîne de caractères.',
            'phone_number.string' => 'Le champ du numéro de téléphone doit être une chaîne de caractères.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
        ];
    }

}

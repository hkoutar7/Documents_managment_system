<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ du nom est requis.',
            'email.required' => 'Le champ de l\'adresse e-mail est requis.',
            'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
            'email.unique' => 'L\'adresse e-mail est déjà utilisée.',
            'password.required' => 'Le champ du mot de passe est requis.',
            'password.same' => 'Le mot de passe doit correspondre au champ de confirmation du mot de passe.',
            'roles.required' => 'Le champ des rôles est requis.',
        ];
    }

}

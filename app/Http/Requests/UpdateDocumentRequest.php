<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:55|string',
            'section' => 'required',
            'description' => 'bail|nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'le titre du document est requis',
            'name.max' => 'Le titre ne peut pas dépasser 55 caractères',
            'name.string' => 'Le titre doit être une chaîne de caractères',
            'name.unique' => 'Ce titre est déjà utilisé',
            'section.required' => 'la section du document est requis',
            'description.string' => 'La description doit être une chaîne de caractères',
        ];
    }
}

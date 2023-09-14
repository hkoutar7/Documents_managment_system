<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "section_name" => "required|unique:sections,name|string|max:50",
            "description" => "nullable",
        ];
    }

    public function messages()
    {
        return [
            "section_name.required" => "Le champ du nom de la section est requis.",
            "section_name.string" => "Le nom de la section doit être une chaîne de caractères.",
            "section_name.max" => "Le nom de la section ne peut pas dépasser 50 caractères.",
            "section_name.unique" => "Ce nom de section existe déjà.",
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $sectionId = $this->route('id'); // Assuming 'section' is the route parameter name for the section's ID.

        return [
            "section_name" => "required|string|max:50" ,
            "description" => "nullable",
        ];
    }


    public function messages()
    {
        return [
            "section_name.required" => "Le champ du nom de la section est requis.",
            "section_name.string" => "Le nom de la section doit être une chaîne de caractères.",
            "section_name.max" => "Le nom de la section ne peut pas dépasser 50 caractères.",
        ];
    }

}

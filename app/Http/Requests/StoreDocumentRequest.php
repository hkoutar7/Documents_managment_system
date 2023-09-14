<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:55|string|unique:App\Models\Document,name',
            'section' => 'required',
            'description' => 'bail|nullable|string',
            'attachment' => ['nullable','file','mimes:pdf,png,jpeg,jpg','max:1024'],
            'client' => 'required|max:55|string',
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
            'attachment.file' => 'Le champ des pièces jointes doit contenir un fichier valide',
            'attachment.mimes' => 'Les types de fichiers autorisés sont PDF, PNG, JPEG et JPG.',
            'attachment.max' => 'La taille maximale du fichier est de 1 Mo.',
            'client.required' => 'Le champ nom du client est requis.',
            'client.max' => 'Le nom du client ne peut pas dépasser 55 caractères.',
            'client.string' => 'Le nom du client doit être une chaîne de caractères.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attachment' => [
                'required',
                'file',
                // 'mimetypes:pdf,xlsx,jpeg,png',
                'max:2048', // 2 MB = 1024 * 2 KB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'attachment.required' => 'Un fichier est requis.',
            'attachment.file' => "L'attachement sélectionné n'est pas valide.",
            'attachment.mimetypes' => 'Seuls les fichiers PDF et les images (JPEG, PNG) sont autorisés.',
            'attachment.max' => 'La taille du fichier ne doit pas dépasser 1 Mo.',
        ];
    }

}

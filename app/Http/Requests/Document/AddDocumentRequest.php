<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class AddDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'projectId' => ['required', 'exists:projects,id'],
            'documents' => ['required', 'array'],
            'documents.*.name' => ['required', 'string'],
            'documents.*.data' => ['required', 'array'],
            'documents.*.data.*.key' => ['required', 'string'],
            'documents.*.data.*.value' => ['required', 'string'],
        ];
    }
}

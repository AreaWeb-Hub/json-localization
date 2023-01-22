<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class GetDocumentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'projectId' => ['required', 'exists:projects,id']
        ];
    }
}

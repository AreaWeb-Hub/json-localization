<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class GetDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lang' => ['required', 'exists:languages,id']
        ];
    }
}

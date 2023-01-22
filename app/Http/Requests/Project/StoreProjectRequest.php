<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:300'],
            'languages' => ['required', 'array', 'required_array_keys:source,target'],
            'languages.source' => ['required', 'int', 'exists:languages,id'],
            'languages.target' => ['required'],
            'languages.target.*' => ['int', 'exists:languages,id'],
            'settings.useMachineTranslate' => ['required', 'bool']
        ];
    }
}

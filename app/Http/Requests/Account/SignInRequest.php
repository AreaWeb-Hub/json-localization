<?php

namespace App\Http\Requests\Account;

use App\Facades\Account;
use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function signIn(): string
    {
        return Account::signIn(
            $this->input('email'),
            $this->input('password'),
        );
    }
}

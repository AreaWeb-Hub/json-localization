<?php

namespace App\Http\Requests\Account;

use App\Enums\AccountType;
use App\Facades\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'accountType' => ['required', 'string', new Enum(AccountType::class)],
            'companyName' => ['required_if:accountType,' . AccountType::LTD->value],
            'password' => ['required', 'required_array_keys:value,confirmation'],
            'password.value' => ['required', 'min:6', 'max:100'],
            'password.confirmation' => ['same:password.value'],
        ];
    }

    public function createAccount()
    {
        Account::create(
            $this->validated()
        );
    }
}

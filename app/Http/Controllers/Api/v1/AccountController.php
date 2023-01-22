<?php

namespace App\Http\Controllers\Api\v1;

use App\Facades\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function create(CreateAccountRequest $request)
    {
        $request->createAccount();
        return responseOk();
    }

    public function signIn(SignInRequest $request)
    {
        return [
            'token' => $request->signIn()
        ];
    }
}

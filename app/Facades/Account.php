<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User create(array $data)
 * @method static string signIn(string $email, string $password)
 *
 * @see \App\Services\Account\AccountService
 */
class Account extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'account_service';
    }
}

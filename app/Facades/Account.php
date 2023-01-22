<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User create(array $data)
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

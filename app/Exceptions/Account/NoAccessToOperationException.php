<?php

namespace App\Exceptions\Account;

use Exception;

class NoAccessToOperationException extends Exception
{
    protected $message = 'NoAccessToOperation';
}

<?php

namespace App\Exceptions\Auth;

use Exception;
use Throwable;

class AuthException extends Exception
{
    public function __construct($message = 'Invalid credentials', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

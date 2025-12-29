<?php

namespace App\Exceptions;

use Exception;

class ExistingUserException extends Exception
{
    protected $message="El usuario ya existe";
}

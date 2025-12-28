<?php

namespace App\Exceptions;

use Exception;

class InvalidDniException extends Exception
{
    protected $message ="Dni incorrecto";
}

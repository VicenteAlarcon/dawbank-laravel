<?php
namespace App\Exceptions;

use Exception;   

class InvalidMovementException extends Exception{
    protected $message="La cantidad del movimiento debe ser mayor que cero";
}
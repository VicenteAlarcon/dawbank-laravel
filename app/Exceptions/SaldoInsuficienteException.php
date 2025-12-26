<?php
namespace App\Exceptions;

use Exception;

class SaldoInsuficienteException extends Exception{

    protected $message = "Saldo insuficiente para realizar la retirada";
}
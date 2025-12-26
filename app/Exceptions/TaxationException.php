<?php
namespace App\Exceptions;

use Exceptions;

class TaxationException extends Exception{

    protected $message="Error en el calculo de impuestos";
}
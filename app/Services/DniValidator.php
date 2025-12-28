<?php
namespace App\Services;

use App\Exceptions\InvalidDniException;

class DniValidator{
    public function validate(string $dni): void 
    {
        //trim($dni)elimina espacios al inicio y al final. strtoupper convierte todo a mayúsculas.//
        $dni = strtoupper(trim($dni));
      if(!preg_match('/^[0-9]{8}[A-Z]$/', $dni)){
        throw new InvalidDniException('Formato de dni inválido');
      }
      $numero = intval(substr($dni, 0, 8));
      $letra = substr($dni, -1);

      //Tabla oficial de letras del DNI. Cada posición corresponde a un resto(0->T, 1->R...)//
      $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

      $letraCorrecta = $letras[$numero % 23];
       
      if($letra !== $letraCorrecta) {
        throw new InvalidDniException('La letra del DNI no es correcta');
      }

    }
}
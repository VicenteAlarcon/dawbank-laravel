<?php
namespace App\Services;

class IbanGenerator{

//Este método lo usamos en el servicio CuentaService para generar iban automáticamente al crear una cuenta.//
  public function generateIban(): string
      {
       $pais = "ES";
       $control = str_pad((string) random_int(0, 99), 2, '0', STR_PAD_LEFT);
       $numero = '';
       for($i=0; $i<20; $i++){
        $numero .= random_int(0, 9);
       }
       return $pais.$control.$numero;
       }
       
     
      }



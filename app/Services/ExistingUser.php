<?php
namespace App\Services;
use App\Models\Cuenta;
use App\Exceptions\ExistingUserException;

class ExistingUser 
{

   public function userDniExists(string $dni):bool {

   return Cuenta::where('dni', $dni)->exists();


   }
}
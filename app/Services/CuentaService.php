<?php
namespace App\Services;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;


class CuentaService{
    
    public function ingresarDinero(Cuenta $cuenta, float $cantidad): void 
    {
        DB::transaction(function () use($cuenta, $cantidad){
            //Creamos movimiento asociado a la operación.

            Movimiento::create([
                'cuenta_id'=>$cuenta->id,
                'cantidad'=>$cantidad,
                'tipo' =>Movimiento::INGRESO,
            ]);

            // Actualizamos saldo y guardamos en BD.
            $cuenta->saldo += $cantidad;
            $cuenta->save();
        });
    }

    public function retirarDinero(Cuenta $cuenta, float $cantidad): void 
    {
      DB::transaction(function () use($cuenta, $cantidad){

        if($cuenta->saldo < $cantidad) {
            throw new \Exception('Saldo insuficiente');
        }
         Movimiento::create([
            'cuenta_id'=>$cuenta->id,
            'cantidad'=>$cuenta->cantidad,
            'tipo'=> Movimiento::RETIRADA,
         ]);
          $cuenta->saldo -= $cantidad;
          $cuenta->save();

      });
    }
}
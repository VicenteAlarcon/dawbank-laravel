<?php
namespace App\Services;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use App\Exceptions\SaldoInsuficienteException;
use App\Exceptions\InvalidMovementException;
use App\Exceptions\TaxationException;
use App\Services\IbanGenerator;


class CuentaService{
    public function __construct(
        private IbanGenerator $ibanGenerator
    ){}
    
    Public function crearCuenta(array $data): Cuenta 
    {
        return Cuenta::create([
           'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'dni' => $data['dni'],
            'iban' => $this->ibanGenerator->generateIban(),
            'saldo' => 0,
        ]);
    }

    //Método para generar iban que viene del servicio IbanGenerator//


     
    public function ingresarDinero(Cuenta $cuenta, float $cantidad): void 
    {
        if($cantidad <= 0) {
            throw new InvalidMovementException();
        }

        if($cantidad > 3000){
            throw new TaxationException('Notificar a hacienda');
        }
        DB::transaction(function () use($cuenta, $cantidad){
 
//creamos la transacción con el método increment que es nativo de Eloquent y refrescamos con refresh 
            $cuenta->increment('saldo', $cantidad);
            $cuenta->refresh();

            //Creamos movimiento asociado a la operación.

            Movimiento::create([
                'cuenta_id'=>$cuenta->id,
                'cantidad'=>$cantidad,
                'tipo' =>Movimiento::INGRESO,
            ]);

          
        });
    }

    public function retirarDinero(Cuenta $cuenta, float $cantidad): void 
    {
     
         if($cantidad <= 0) {
            throw new InvalidMovementException('La cantidad debe ser mayor que cero');
        }
        if($cuenta->saldo < $cantidad) {
            throw new SaldoInsuficienteException();
        }
 DB::transaction(function () use($cuenta, $cantidad){
         $cuenta->decrement('saldo', $cantidad);
         $cuenta->refresh();
         Movimiento::create([
            'cuenta_id'=>$cuenta->id,
            'cantidad'=>$cantidad,
            'tipo'=> Movimiento::RETIRADA,
         ]);
      });
    }
}
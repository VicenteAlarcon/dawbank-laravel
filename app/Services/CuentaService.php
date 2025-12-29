<?php
namespace App\Services;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use App\Exceptions\SaldoInsuficienteException;
use App\Exceptions\InvalidMovementException;
use App\Exceptions\TaxationException;
use App\Exceptions\ExistingUserException;
use App\Services\IbanGenerator;
use App\Services\DniValidator;
use App\Services\ExistingUser;


class CuentaService{
    public function __construct(
        private IbanGenerator $ibanGenerator,
        private DniValidator $dniValidator,
        private ExistingUSer $existingUser
    ){}
    
    Public function crearCuenta(array $data): Cuenta 
    {
        
      
         if (!isset($data['nombre'], $data['apellidos'], $data['dni'])) {
    throw new InvalidArgumentException('Missing required account data');
        }  

         $this->dniValidator->validate($data['dni']);
    
         if($this->existingUser->userDniExists($data['dni'])){
            throw new ExistingUserException("El usuario  ya existe");
         }

         $iban = $this->ibanGenerator->generateIban();
         

        return Cuenta::create([
           'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'dni' => $data['dni'],
            'iban' => $iban,
            'saldo' => 0,
        ]);
    }

    


     
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
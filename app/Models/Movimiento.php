<?php

namespace App\Models;
use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Model;
class Movimiento extends Model
{
   
    public const INGRESO = 'ingreso';
    public const RETIRADA = 'retirada';
    protected $fillable = [
        'cuenta_id',
        'cantidad',
        'tipo'

    ];


    public function cuenta() 
    {
        return $this->belongsTo(Cuenta::class);
    }
}

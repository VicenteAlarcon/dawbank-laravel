<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Movimiento;

class Cuenta extends Model
{
use SoftDeletes, HasFactory;
    protected $casts = [
    'iban' => 'string',
];
   protected $fillable = [
    'nombre',
    'apellidos',
    'dni',
    'iban',
    'saldo'
   ];

   public function movimientos() {
    return $this->hasMany(Movimiento::class);
   }

}

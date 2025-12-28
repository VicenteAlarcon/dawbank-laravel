<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CuentaController;
Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::post('/cuentas/{cuenta}/retirar', [CuentaController::class, 'retirar']);
Route::post('/cuentas/{cuenta}/ingresar', [CuentaController::class, 'ingresar']);
Route::post('/cuentas', [CuentaController::class, 'store']);
Route::get('test', [CuentaController::class, 'test']);
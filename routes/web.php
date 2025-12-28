<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuentaWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cuentas/create', [CuentaWebController::class, 'create']);
Route::post('/cuentas', [CuentaWebController::class, 'store']);
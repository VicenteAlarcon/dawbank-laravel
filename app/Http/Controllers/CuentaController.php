<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cuenta;
use App\Http\Requests\StoreCuentaRequest;
use App\Services\CuentaService;


class CuentaController extends Controller
{
     public function store(StoreCuentaRequest $request, CuentaService $service)
    {
        $cuenta = $service->crearCuenta($request->validated());

        return response()->json($cuenta, 201);

    }

    public function ingresar(Request $request, Cuenta $cuenta, CuentaService $service)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:0.01',
        ]);

        $service->ingresarDinero($cuenta, $request->cantidad);

        return response()->json([
            'mensaje' => 'Ingreso realizado con éxito',
            'cuenta' => $cuenta->refresh()
        ]);
    }

    public function retirar(Request $request, Cuenta $cuenta, CuentaService $service)
    {
        $service->retirarDinero($cuenta, $request->input('cantidad'));
        return response()->json($cuenta->fresh());
    }

        public function test()
    {
        return response()->json(['mensaje' => 'API funcionando']);
    }
}

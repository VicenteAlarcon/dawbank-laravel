<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCuentaRequest;
use App\Services\CuentaService;
use Illuminate\Http\JsonResponse;

class CuentaController extends Controller
{
        public function store(
        StoreCuentaRequest $request,
        CuentaService $cuentaService
    ): JsonResponse {

        $cuenta = $cuentaService->crearCuenta(
            $request->validated()
        );

        return response()->json($cuenta, 201);
    }
}

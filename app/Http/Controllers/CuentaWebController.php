<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CuentaService;
use App\Exceptions\InvalidDniException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCuentaRequest;


class CuentaWebController extends Controller
{
    public function __construct(
        private CuentaService $cuentaService
    ) {}

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(StoreCuentaRequest $request): RedirectResponse
    {
        try {
            $this->cuentaService->crearCuenta($request->validated());

            return redirect()
                ->back()
                ->with('success', 'Cuenta creada correctamente');

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'dni' => $e->getMessage()
                ])
                ->withInput();
        }
    }
}

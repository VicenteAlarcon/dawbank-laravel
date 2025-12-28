<?php
namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\InvalidMovementException;
use App\Exceptions\SaldoInsuficienteException;
use App\Exceptions\TaxationException;
use Illuminate\Http\JsonResponse;
class Handler extends ExceptionHandler{


public function register(): void
{
    $this->renderable(function (InvalidMovementException $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 400);
    });

    $this->renderable(function (SaldoInsuficienteException $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 409);
    });

    $this->renderable(function (TaxationException $e) {
        return response()->json([
            'warning' => $e->getMessage()
        ], 202);
    });

    $this->rendrable(function (InvalidDniException $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 422);
    });
}
}
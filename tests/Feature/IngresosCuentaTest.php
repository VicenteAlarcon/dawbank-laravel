<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cuenta;
use App\Services\CuentaService;
use App\Exceptions\InvalidMovementException;
use App\Exceptions\TaxationException;
use Database\Factories\CuentaFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngresosCuentaTest extends TestCase
{
    use RefreshDatabase;

    private CuentaService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(CuentaService::class);
    }

    /** @test */
    public function it_allows_valid_deposit()
    {
        $cuenta = Cuenta::factory()->create(['saldo' => 0]);

        $this->service->ingresarDinero($cuenta, 500);

        $cuenta->refresh();

        $this->assertEquals(500, $cuenta->saldo);
    }

    /** @test */
    public function it_rejects_negative_or_zero_deposit()
    {
        $cuenta = Cuenta::factory()->create(['saldo' => 0]);

        $this->expectException(InvalidMovementException::class);

        $this->service->ingresarDinero($cuenta, -100);
    }

    /** @test */
    public function it_triggers_taxation_exception_for_large_deposit()
    {
        $cuenta = Cuenta::factory()->create(['saldo' => 0]);

        $this->expectException(TaxationException::class);

        $this->service->ingresarDinero($cuenta, 5000); // >3000 según tu lógica
    }
}

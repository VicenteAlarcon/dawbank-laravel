<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreCuentaTest extends TestCase
{
   use RefreshDatabase;

   public function test_it_creates_a_cuenta_with_valid_data(): void
{
    $response = $this->postJson('/api/cuentas', [
        'nombre' => 'Vicente',
        'apellidos' => 'Alarcón',
        'dni' => '12345678Z',
    ]);

    $response->assertStatus(201);

    $response->assertJsonStructure([
        'id',
        'nombre',
        'apellidos',
        'dni',
        'iban',
        'saldo',
        'created_at',
        'updated_at',
    ]);

    $this->assertDatabaseHas('cuentas', [
        'dni' => '12345678Z',
        'saldo' => 0,
    ]);
}

public function test_nombre_is_required(): void
{
    $response = $this->postJson('/api/cuentas', [
        'apellidos' => 'Alarcón',
        'dni' => '12345678Z',
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('nombre');
}
public function test_dni_must_have_9_characters(): void
{
    $response = $this->postJson('/api/cuentas', [
        'nombre' => 'Vicente',
        'apellidos' => 'Alarcón',
        'dni' => '123',
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('dni');
}
public function test_it_fails_when_dni_is_invalid(): void
{
    $response = $this->postJson('/api/cuentas', [
        'nombre' => 'Vicente',
        'apellidos' => 'Alarcón',
        'dni' => '12345678A', // letra incorrecta
    ]);

    $response->assertStatus(400);

    $response->assertJson([
        'message' => 'DNI inválido',
    ]);
}


}

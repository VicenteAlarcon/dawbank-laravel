<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cuenta;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuenta>
 */
class CuentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Cuenta::class;
    public function definition(): array
    {
        return [
               'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'dni' => $this->faker->regexify('[0-9]{8}[A-Z]'),
            'iban' => 'ES' . $this->faker->numerify('##########'), // simplificado
            'saldo' => 0,
        ];
    }
}

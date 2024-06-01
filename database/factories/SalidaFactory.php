<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Medicamento;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salida>
 */
class SalidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Motivos posibles para la salida
        $motivos = ['venta', 'vencimiento', 'devolución'];

        return [
            'fecha' => $this->faker->dateTimeThisYear,
            'medicamento' => Medicamento::factory(),  // Assuming you have a Medicamento model and factory
            'cantidad' => $this->faker->numberBetween(1, 100),
            'motivo' => $this->faker->randomElement($motivos),
            'id_usuario' => User::factory(),  // Assuming you have a User model and factory
        ];
    }
}

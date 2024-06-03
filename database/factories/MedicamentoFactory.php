<?php

namespace Database\Factories;

use App\Models\Medicamento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicamento>
 */
class MedicamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'descripción' => $this->faker->sentence,
            'fecha_vencimiento' => $this->faker->dateTimeBetween('now', '+2 years'),
            'categoría' => $this->faker->word,
            'cantidad' => $this->faker->numberBetween(1, 1000),
            'precio' => $this->faker->randomFloat(2, 1, 1000),
            'laboratorio' => $this->faker->company,
        ];
    }
}

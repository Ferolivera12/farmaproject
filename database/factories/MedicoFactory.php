<?php

namespace Database\Factories;

use App\Models\Medico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medico>
 */
class MedicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cedula' => $this->faker->unique()->randomNumber(8, true), // Genera un ID único de 8 dígitos
            'nombre' => $this->faker->name(),
            'area' => $this->faker->randomElement(['General', 'Pediatría', 'Cardiología', 'Neurología']), // Ejemplos de áreas
            'id_usuario' => User::factory(), // Relaciona el médico con un usuario existente
        ];
    }
}

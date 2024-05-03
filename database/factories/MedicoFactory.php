<?php

namespace Database\Factories;

use App\Models\Medico; // Reemplaza con la ruta de tu modelo si es diferente
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker; // Alias para la clase Faker

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
            'id_usuario' => UsuarioFactory::new()->create()->id, // Crea un usuario relacionado y asigna el ID
        ];
    }
}

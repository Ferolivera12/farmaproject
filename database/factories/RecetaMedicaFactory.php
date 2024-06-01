<?php

namespace Database\Factories;

use App\Models\RecetaMedica;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecetaMedicaFactory extends Factory
{
    protected $model = RecetaMedica::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'paciente' => $this->faker->name(),
        ];
    }
}

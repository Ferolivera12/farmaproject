<?php

namespace Database\Factories;

use App\Models\DetalleReceta;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleRecetaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetalleReceta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_receta' => $this->faker->numberBetween(1, 100),
            'id_medicamento' => $this->faker->numberBetween(1, 50),
            'cantidad' => $this->faker->numberBetween(1, 10),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entrada;
use Faker\Generator as Faker;

class EntradaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entrada::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'fecha_hora' => $this->faker->dateTime(),
            'id_Pedido' => $this->faker->numberBetween(1, 100),
            'medicamento' => $this->faker->word(),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'lote' => $this->faker->bothify('L###'),
            'fecha_vencimiento' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'id_usuario' => $this->faker->numberBetween(1, 50),
        ];
    }
}

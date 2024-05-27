<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cantidad = $this->faker->numberBetween(1, 100);
        $precioUnitario = $this->faker->randomFloat(2, 1, 100);
        $importeTotal = $cantidad * $precioUnitario;
        $estados = ['pendiente', 'recibido', 'cancelado'];

        return [
            'fecha_hora' => $this->faker->dateTime(),
            'cantidad' => $cantidad,
            'precio_unitario' => $precioUnitario,
            'importe_total' => $importeTotal,
            'estado' => $this->faker->randomElement($estados),
            'id_usuario' => \App\Models\User::factory(), // Asume que existe un modelo de Usuario
        ];
    }
}

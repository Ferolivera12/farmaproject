<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = [
            [
                'fecha_hora' => '2024-06-01 10:00:00',
                'cantidad' => 10,
                'precio_unitario' => 5.00,
                'importe_total' => 50.00,
                'estado' => 'Pendiente',
                'id_usuario' => 1, // Asumiendo que hay un usuario con ID 1
                'id_proveedor' => 1,
            ],
            [
                'fecha_hora' => '2024-06-02 11:00:00',
                'cantidad' => 20,
                'precio_unitario' => 4.50,
                'importe_total' => 90.00,
                'estado' => 'Completado',
                'id_usuario' => 1,
                'id_proveedor' => 2,
            ],
            [
                'fecha_hora' => '2024-06-03 12:00:00',
                'cantidad' => 30,
                'precio_unitario' => 3.75,
                'importe_total' => 112.50,
                'estado' => 'En Proceso',
                'id_usuario' => 1,
                'id_proveedor' => 3,
            ],
            [
                'fecha_hora' => '2024-06-04 13:00:00',
                'cantidad' => 15,
                'precio_unitario' => 6.00,
                'importe_total' => 90.00,
                'estado' => 'Cancelado',
                'id_usuario' => 1,
                'id_proveedor' => 4,
            ],
            [
                'fecha_hora' => '2024-06-05 14:00:00',
                'cantidad' => 25,
                'precio_unitario' => 7.00,
                'importe_total' => 175.00,
                'estado' => 'Pendiente',
                'id_usuario' => 1,
                'id_proveedor' => 5,
            ],
        ];

        foreach ($pedidos as $pedido) {
            Pedido::create($pedido);
        }
    }
}

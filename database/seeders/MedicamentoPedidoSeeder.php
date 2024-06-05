<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicamentoPedido;

class MedicamentoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicamento_pedidos = [
            ['id_medicamento' => 1, 'id_pedido' => 1],
            ['id_medicamento' => 2, 'id_pedido' => 2],
            ['id_medicamento' => 3, 'id_pedido' => 3],
            ['id_medicamento' => 4, 'id_pedido' => 4],
            ['id_medicamento' => 5, 'id_pedido' => 5],
        ];

        foreach ($medicamento_pedidos as $medicamento_pedido) {
            MedicamentoPedido::create($medicamento_pedido);
        }
    }
}

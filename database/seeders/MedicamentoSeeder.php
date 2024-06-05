<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicamento;

class MedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicamentos = [
            [
                'nombre' => 'Paracetamol',
                'descripcion' => 'Analgésico y antipirético',
                'fechavencimiento' => '2026-06-01',
                'categoria_id' => '4',
                'precio' => 4.99,
                'laboratorio' => 'Laboratorios ABC',
            ],
            [
                'nombre' => 'Amoxicilina',
                'descripcion' => 'Antibiótico de amplio espectro',
                'fechavencimiento' => '2025-06-01',
                'categoria_id' => '5',
                'precio' => 12.5,
                'laboratorio' => 'Farmacéutica 123',
            ],
            [
                'nombre' => 'Lorazepam',
                'descripcion' => 'Ansiolítico',
                'fechavencimiento' => '2026-06-01',
                'categoria_id' => '3',
                'precio' => 15,
                'laboratorio' => 'Medicamentos SA',
            ],
            [
                'nombre' => 'Metformina',
                'descripcion' => 'Tratamiento para la diabetes tipo 2',
                'fechavencimiento' => '2026-06-01',
                'categoria_id' => '4',
                'precio' => 9.75,
                'laboratorio' => 'Salud y Vida',
            ],
            [
                'nombre' => 'Omeprazol',
                'descripcion' => 'Inhibidor de la bomba de protones',
                'fechavencimiento' => '2025-12-01',
                'categoria_id' => '3',
                'precio' => 5.5,
                'laboratorio' => 'Gastrofarma',
            ],
        ];

        // Crear los registros de medicamentos en la base de datos
        foreach ($medicamentos as $medicamento) {
            Medicamento::create($medicamento);
        }
    }
}

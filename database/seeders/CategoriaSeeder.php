<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 5 categorías de ejemplo
        Categoria::create([
            'nombre' => 'Antibióticos',
            'descripcion' => 'Medicamentos para tratar infecciones bacterianas.'
        ]);

        Categoria::create([
            'nombre' => 'Analgésicos',
            'descripcion' => 'Medicamentos para aliviar el dolor.'
        ]);

        Categoria::create([
            'nombre' => 'Antihistamínicos',
            'descripcion' => 'Medicamentos para tratar alergias.'
        ]);

        Categoria::create([
            'nombre' => 'Antiinflamatorios',
            'descripcion' => 'Medicamentos para reducir la inflamación.'
        ]);

        Categoria::create([
            'nombre' => 'Antipiréticos',
            'descripcion' => 'Medicamentos para reducir la fiebre.'
        ]);
    }
}

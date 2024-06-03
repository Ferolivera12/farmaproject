<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::factory()->create([
            'nombre' => 'Cardiología',
            'ubicacion' => 'Edificio A, Piso 3',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Neurología',
            'ubicacion' => 'Edificio B, Piso 2',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Pediatría',
            'ubicacion' => 'Edificio C, Piso 1',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Ortopedia',
            'ubicacion' => 'Edificio D, Piso 4',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Urgencias',
            'ubicacion' => 'Edificio E, Planta Baja',
        ]);

        Departamento::factory()->create([
            'nombre' => 'Oncología',
            'ubicacion' => 'Edificio F, Piso 5',
        ]);
    }
}

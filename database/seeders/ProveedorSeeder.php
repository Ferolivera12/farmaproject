<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 6 proveedores de ejemplo
        Proveedor::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'telefono' => '123456789'
        ]);

        Proveedor::create([
            'nombre' => 'María',
            'apellidos' => 'García',
            'telefono' => '987654321'
        ]);

        Proveedor::create([
            'nombre' => 'Carlos',
            'apellidos' => 'López',
            'telefono' => '234567890'
        ]);

        Proveedor::create([
            'nombre' => 'Ana',
            'apellidos' => 'Martínez',
            'telefono' => '345678901'
        ]);

        Proveedor::create([
            'nombre' => 'Luis',
            'apellidos' => 'Rodríguez',
            'telefono' => '456789012'
        ]);

        Proveedor::create([
            'nombre' => 'Sofía',
            'apellidos' => 'Hernández',
            'telefono' => '567890123'
        ]);
    }
}

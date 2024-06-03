<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $escritor = Role::firstOrCreate(['name' => 'Escritor']);

        Permission::firstOrCreate(['name' => 'crear receta'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar receta'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver receta'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminar receta'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear medico'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'editar medico'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'ver medico'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'eliminar medico'])->assignRole([$admin]);

        Permission::firstOrCreate(['name' => 'crear medicamento'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar medicamento'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver medicamento'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminar medicamento'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear categoria'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar categoria'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver categoria'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminar categoria'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear departamento'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'editar departamento'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'ver departamento'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'eliminar departamento'])->assignRole([$admin]);

        Permission::firstOrCreate(['name' => 'crear entrada'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar entrada'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver entrada'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminar entrada'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear salida'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar salida'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver salida'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminars salida'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear pedido'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'editar pedido'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'ver pedido'])->assignRole([$admin, $escritor]);
        Permission::firstOrCreate(['name' => 'eliminar pedido'])->assignRole([$admin, $escritor]);

        Permission::firstOrCreate(['name' => 'crear proveedor'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'editar proveedor'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'ver proveedor'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'eliminar proveedor'])->assignRole([$admin]);

        Permission::firstOrCreate(['name' => 'crear usuario'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'editar usuario'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'ver usuario'])->assignRole([$admin]);
        Permission::firstOrCreate(['name' => 'eliminar usuario'])->assignRole([$admin]);
    }
}

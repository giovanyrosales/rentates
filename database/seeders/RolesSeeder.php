<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // --- CREAR ROLES ---

        // encargado administrador
        $role1 = Role::create(['name' => 'Encargado-Administrador']);

        // encargado del area de Renta
        $role2 = Role::create(['name' => 'Encargado-Renta']);


        // --- CREAR PERMISOS ---

        // visualizar roles y permisos
        Permission::create(['name' => 'url.roles.permisos.index', 'description' => 'Cuando hace login, se podra visualizar roles y permisos'])->syncRoles($role1);

        // redireccionamiento a url - encargado de Renta
        Permission::create(['name' => 'url.renta.index', 'description' => 'Cuando hace login, se redirigirá la vista Proveedor Crear'])->syncRoles($role2);


    }
}
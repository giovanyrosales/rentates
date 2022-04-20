<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * usuario por defecto.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nombre' => 'Giovany',
            'apellido' => 'Rosales',
            'usuario' => 'admin',
            'password' => bcrypt('admin'),
            'activo' => 1
        ])->assignRole('Encargado-Administrador');

        Usuario::create([
            'nombre' => 'Cristina',
            'apellido' => 'Villanueva',
            'usuario' => 'cristina',
            'password' => bcrypt('admin'),
            'activo' => 1
        ])->assignRole('Encargado-Renta');
    }
}

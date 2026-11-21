<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'username' => 'admin',
            'password' => Hash::make('123456'), // Contraseña encriptada
            'nombre' => 'Fernando',
            'apellido' => 'Admin',
            'email' => 'admin@test.com',
            'tipo' => 'admin',
            'descripcion' => 'Usuario de prueba',
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Administrador::create([
            'nombre' => 'Jonathan',
            'apellido' => 'Moran',
            'usuario' => 'tatan',
            'password' => Hash::make('1234'),
            'correo' => 'tatangamess@gmail.com',
            'token_correo' => null,
            'token_fecha' => null
        ])->assignRole('admin');

        Administrador::create([
            'nombre' => 'Editor',
            'apellido' => 'Moran',
            'usuario' => 'editor',
            'password' => Hash::make('1234'),
            'correo' => 'editor@gmail.com',
            'token_correo' => null,
            'token_fecha' => null
        ])->assignRole('editor');

        Administrador::create([
            'nombre' => 'Cliente',
            'apellido' => 'Moran',
            'usuario' => 'cliente',
            'password' => Hash::make('1234'),
            'correo' => 'cliente@gmail.com',
            'token_correo' => null,
            'token_fecha' => null
        ])->assignRole('cliente');
    }
}



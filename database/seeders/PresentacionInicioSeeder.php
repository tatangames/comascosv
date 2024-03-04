<?php

namespace Database\Seeders;

use App\Models\PresentacionInicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresentacionInicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PresentacionInicio::create([
            'titulo' => 'hola',
            'descripcion' => 'holisss',
            'imagen' => 'xxx.jpg',
            'posicion' => '1'
        ]);

        PresentacionInicio::create([
            'titulo' => 'hola 2',
            'descripcion' => 'holisss 2',
            'imagen' => 'xxx.jpg',
            'posicion' => '2'
        ]);

        PresentacionInicio::create([
            'titulo' => 'hola 3',
            'descripcion' => 'holisss 3',
            'imagen' => 'xxx.jpg',
            'posicion' => '3'
        ]);

        PresentacionInicio::create([
            'titulo' => 'hola 4',
            'descripcion' => 'holisss 4',
            'imagen' => 'xxx.jpg',
            'posicion' => '4'
        ]);
    }
}

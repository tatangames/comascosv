<?php

namespace Database\Seeders;

use App\Models\Recursos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recursos::create([
            'quienes_somos' => 'hola',
            'detalle_contacto' => 'hola',
            'telefono' => '75825072'
        ]);
    }
}

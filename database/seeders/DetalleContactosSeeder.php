<?php

namespace Database\Seeders;

use App\Models\DetallesContacto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetalleContactosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetallesContacto::create([
            'id_tipos_contactos' => '1',
            'nombre' => 'WhatsApp',
            'visible' => '1',
            'posicion' => '1'
        ]);

        DetallesContacto::create([
            'id_tipos_contactos' => '2',
            'nombre' => 'Yotube',
            'visible' => '1',
            'posicion' => '2'
        ]);

        DetallesContacto::create([
            'id_tipos_contactos' => '3',
            'nombre' => 'Facebook',
            'visible' => '1',
            'posicion' => '3'
        ]);

        DetallesContacto::create([
            'id_tipos_contactos' => '4',
            'nombre' => 'Tik Tok',
            'visible' => '1',
            'posicion' => '4'
        ]);

        DetallesContacto::create([
            'id_tipos_contactos' => '5',
            'nombre' => 'Instagram',
            'visible' => '1',
            'posicion' => '5'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\TipoContactoVendedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoContactoVendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoContactoVendedor::create([
            'nombre' => 'Teléfono',
        ]);

        TipoContactoVendedor::create([
            'nombre' => 'Ubicación',
        ]);

        TipoContactoVendedor::create([
            'nombre' => 'Correo',
        ]);
    }
}

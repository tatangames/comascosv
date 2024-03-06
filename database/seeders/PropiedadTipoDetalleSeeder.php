<?php

namespace Database\Seeders;

use App\Models\PropiedadTipoDetalle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropiedadTipoDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropiedadTipoDetalle::create([
            'nombre' => 'Lleva título y descripción',
        ]);

        PropiedadTipoDetalle::create([
            'nombre' => 'Lleva título',
        ]);
    }
}

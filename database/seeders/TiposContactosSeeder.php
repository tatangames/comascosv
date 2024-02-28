<?php

namespace Database\Seeders;

use App\Models\TiposContactos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposContactosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TiposContactos::create([
            'nombre' => 'WhatsApp',
        ]);

        TiposContactos::create([
            'nombre' => 'Youtube',
        ]);

        TiposContactos::create([
            'nombre' => 'Facebook',
        ]);

        TiposContactos::create([
            'nombre' => 'Tik Tok',
        ]);

        TiposContactos::create([
            'nombre' => 'Instagram',
        ]);

    }
}

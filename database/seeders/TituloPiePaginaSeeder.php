<?php

namespace Database\Seeders;

use App\Models\TituloPiePagina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TituloPiePaginaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TituloPiePagina::create([
            'titulo' => '¿Que hacemos?',
        ]);

        TituloPiePagina::create([
            'titulo' => '¿Porque unirse?',
        ]);
    }
}

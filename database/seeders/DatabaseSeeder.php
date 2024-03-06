<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolesSeeder::class);
        $this->call(AdministradorSeeder::class);
        $this->call(TiposContactosSeeder::class);
        $this->call(RecursosSeeder::class);
        $this->call(PresentacionInicioSeeder::class);
        $this->call(DetalleContactosSeeder::class);
        $this->call(PropiedadTipoDetalleSeeder::class);
        $this->call(TituloPiePaginaSeeder::class);
        $this->call(DescripcionPiePaginaSeeder::class);

    }
}

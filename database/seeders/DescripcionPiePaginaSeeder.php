<?php

namespace Database\Seeders;

use App\Models\DescripcionPiePagina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DescripcionPiePaginaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DescripcionPiePagina::create([
            'id_titulopiepagina' => 1,
            'posicion' => 1,
            'nombre' => 'Comascosv Ofrece Servicios De Promoción De Inmuebles Y Crea Pequeños Proyectos Inmobiliarios.',
        ]);


        DescripcionPiePagina::create([
            'id_titulopiepagina' => 1,
            'posicion' => 2,
            'nombre' => 'Al Ser Un Cliente Vendedor De Comascosv, Te Trae Grandes Beneficios. En El Recorrido De Comascosv, Muchos Clientes Vendedores Han Sido Beneficiados, Gracias A El Efícaz Trabajo Que Hemos Hecho, Han Vendido Rápido.',
        ]);

        //**********************


        DescripcionPiePagina::create([
            'id_titulopiepagina' => 2,
            'posicion' => 1,
            'nombre' => 'Tu Anuncio Estará Visible Nacional E Internacional.',
        ]);

        DescripcionPiePagina::create([
            'id_titulopiepagina' => 2,
            'posicion' => 2,
            'nombre' => 'Tu Anuncio Estará Visible Día Y Noche.',
        ]);

        DescripcionPiePagina::create([
            'id_titulopiepagina' => 2,
            'posicion' => 3,
            'nombre' => 'Podrás Ver La Estadística De Reacciones. Todo Esto A Un Super Costo, Ya Que Pretendemos Ayudar, Sobre Todo A Aquellos Que Buscan Comprar Algo Cómodo.',
        ]);

    }
}

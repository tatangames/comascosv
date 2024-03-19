<?php

namespace App;

use App\Models\DescripcionPiePagina;
use App\Models\Recursos;
use App\Models\TituloPiePagina;

class InfoRecursosGet
{
    // OBTENER DATOS DE PIE DE PAGINA, PORQUE SE MOSTRARA EN VARIAS PAGINAS
    public function retornoDatosPiePagina(){

        $dato1 = TituloPiePagina::where('id', 1)->first();
        $columna1 = $dato1->titulo;

        $dato2 = TituloPiePagina::where('id', 2)->select('titulo')->first();
        $columna2 = $dato2->titulo;

        $listaColumna1 = DescripcionPiePagina::where('id_titulopiepagina', 1)
            ->orderBy('posicion', 'ASC')
            ->get();

        $listaColumna2 = DescripcionPiePagina::where('id_titulopiepagina', 2)
            ->orderBy('posicion', 'ASC')
            ->get();



        // INFORMACION RECURSOS
        $infoRecursos = Recursos::where('id', 1)->first();
        $descripcionPagina = $infoRecursos->descripcion_pagina;

        $telefonoFormat = "";
        if($infoRecursos->telefono != null){
            $telefonoFormat = substr_replace($infoRecursos->telefono, '-', 4, 0);
        }

        return ['columna1' => $columna1,
                'columna2' => $columna2,
                'listado1' => $listaColumna1,
                'listado2' => $listaColumna2,
            'descripcionPagina' => $descripcionPagina,
            'telefonoFormat' => $telefonoFormat,
            'telefono' => $infoRecursos->telefono,
            'url_youtube' => $infoRecursos->url_youtube,
            'url_facebook' => $infoRecursos->url_facebook
            ];
    }
}


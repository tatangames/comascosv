<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\DetallesContacto;
use App\Models\PreguntasFrecuentes;
use App\Models\Propiedad;
use App\Models\PropiedadImagenes;
use App\Models\Recursos;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Mews\Purifier\Facades\Purifier;

class FrontendRecursosController extends Controller
{

    public function vistaFaq()
    {
        $listado = PreguntasFrecuentes::orderBy('posicion', 'ASC')->get();


        return view('frontend.paginas.dudas.vistadudas', compact('listado'));
    }

    public function vistaContacto()
    {
        $arrayContacto = DetallesContacto::orderBy('posicion', 'ASC')->get();

        foreach ($arrayContacto as $dato) {

            $modificado = "";
            if($dato->id_tipos_contactos == 1){
                $modificado = substr_replace($dato->nombre, '-', 4, 0);
            }

            $dato->numeroFormat = $modificado;
        }

        return view('frontend.paginas.contacto.vistacontacto', compact('arrayContacto'));
    }

    public function vistaQuienesSomos()
    {
        $infoRecursos = Recursos::where('id', 1)->first();

        return view('frontend.paginas.acercade.vistaacercade', compact('infoRecursos'));
    }


    public function propiedadSlug($slug){

        if($infoPropi = Propiedad::where('slug', $slug)->first()){

            $arrayImagenes = PropiedadImagenes::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->get();

            $contador = -1;
            foreach ($arrayImagenes as $dato){
                $contador++;
                $dato->contador = $contador;
            }

            $precioFormat = '$ ' . number_format((float)$infoPropi->precio, 2, '.', ',');



            return view('frontend.paginas.propiedadslug.vistapropiedadslug', compact('infoPropi',
                'precioFormat',
                           'arrayImagenes'));
        }else{
            return view('errors.404');
        }


    }



}

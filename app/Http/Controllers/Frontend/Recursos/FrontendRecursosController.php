<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\PreguntasFrecuentes;
use Illuminate\Http\Request;

class FrontendRecursosController extends Controller
{

    public function vistaFaq()
    {
        $listado = PreguntasFrecuentes::orderBy('posicion', 'ASC')->get();


        return view('frontend.paginas.dudas.vistadudas', compact('listado'));
    }

    public function vistaContacto()
    {
        return view('frontend.paginas.contacto.vistacontacto');
    }

    public function vistaQuienesSomos()
    {
        return view('frontend.paginas.acercade.vistaacercade');
    }



}

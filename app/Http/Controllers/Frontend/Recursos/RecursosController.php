<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecursosController extends Controller
{

    public function vistaFaq()
    {
        return view('frontend.paginas.dudas.vistadudas');
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

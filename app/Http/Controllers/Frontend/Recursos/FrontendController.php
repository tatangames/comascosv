<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function vistaInicio()
    {

        return view('construccion');

        $tipoBody = 1;

        return view('frontend.index', compact('tipoBody'));
    }



}

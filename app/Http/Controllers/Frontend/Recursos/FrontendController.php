<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\PresentacionInicio;
use App\Models\PropiedadInicio;
use App\Models\Recursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function vistaInicio()
    {
        $tipoBody = 1;

        $arrayInicio = PresentacionInicio::orderBy('posicion', 'ASC')->get();
        $infoRecursos = Recursos::where('id', 1)->first();

        foreach ($arrayInicio as $dato){

            $telefono = "";
            $telefonoFormat = "";
            if($dato->id == 1){
                if($infoRecursos->telefono != null){
                    $telefono = $infoRecursos->telefono;
                    $telefonoFormat = substr_replace($infoRecursos->telefono, '-', 4, 0);
                }
            }

            $dato->telefono = $telefono;
            $dato->telefonoFormat = $telefonoFormat;
        }

        // listado de propiedades
        $arrayPropiedades = PropiedadInicio::orderBy('posicion', 'ASC')->get();

        foreach ($arrayPropiedades as $dato){



        }

        return view('frontend.index', compact('tipoBody', 'arrayInicio', 'infoRecursos', 'arrayPropiedades'));
    }


    public function vistaLogin()
    {

        // reidireccionar si ya inicio sesion
        if (Auth::guard('admin')->check()) {
            return redirect('/panel');
        }

        return view('frontend.login.vistalogin');
    }


}

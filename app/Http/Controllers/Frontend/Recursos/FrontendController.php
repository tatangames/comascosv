<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\PresentacionInicio;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadInicio;
use App\Models\Recursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function vistaInicio()
    {
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
        $resultsBloque = array();
        $index = 0;

        foreach ($arrayPropiedades as $dato){
            array_push($resultsBloque, $dato);

            $infoPropiedad = Propiedad::where('id', $dato->id_propiedad)->first();

            $dato->etiquetaizquierda = $infoPropiedad->vineta_izquierda;
            $dato->etiquetaderecha = $infoPropiedad->vineta_derecha;
            $dato->titulo = $infoPropiedad->nombre;
            $dato->subtitulo = $infoPropiedad->direccion;
            $dato->precioFormat = '$ ' . number_format((float)$infoPropiedad->precio, 2, '.', ',');

            $dato->slug = $infoPropiedad->slug;

            // obtener la primera imagen ordenado por posicion
            if($datoImagen = PropiedadImagenes::where('id_propiedad', $infoPropiedad->id)
                ->orderBy('posicion', 'ASC')
                ->take(1)
                ->first()){

                $propiImagen = $datoImagen->imagen;
            }else{
                $propiImagen = null;
            }

            $dato->propiimagen = $propiImagen;

            // listado de etiquetas principales
            $listado4Tag = Propiedad4Tag::where('id_propiedad', $dato->id_propiedad)
                ->orderBy('posicion', 'ASC')
                ->get();

            foreach ($listado4Tag as $jj){

                $infoImagen = PropiedadImagen4Tag::where('id', $jj->id_imagen4tag)->first();
                $jj->imagen = $infoImagen->imagen;
            }

            $resultsBloque[$index]->detalle = $listado4Tag;
            $index++;
        }

        return view('frontend.index', compact( 'arrayInicio', 'infoRecursos', 'arrayPropiedades'));
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

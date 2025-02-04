<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\InfoRecursosGet;
use App\Models\Lugares;
use App\Models\LugaresInicio;
use App\Models\PresentacionInicio;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadInicio;
use App\Models\Recursos;
use App\Models\Recursos2;
use App\Models\Solicitudes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function vistaInicio()
    {
        $arrayInicio = PresentacionInicio::orderBy('posicion', 'ASC')->get();
        $infoRecursos = Recursos::where('id', 1)->first();
        $fechaActualPuro = Carbon::now('America/El_Salvador')->toDateString();
        $fechaActual = Carbon::parse($fechaActualPuro);

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

        // LISTADO DE PROPIEDADES INICIO, NECESITO SABER SI ESTAMOS ENTRE FECHA INIO Y FECHA FIN
        // PARA SER MOSTRADO
        $arrayPropiDato = PropiedadInicio::all();



        // guardar id propiedad inicio y despues buscar por posicion
        $pilaIdPropiInicio = array();

        foreach ($arrayPropiDato as $info){

            $infoPropi = Propiedad::where('id', $info->id_propiedad)->first();

            // LA PROPIEDAD DEBE ESTAR VISIBLE
            if($infoPropi->visible == 1){

                $fechaInicio = Carbon::parse($infoPropi->fecha_inicio);
                $fechaFin = Carbon::parse($infoPropi->fecha_fin);
                $fechaActual = Carbon::now();

                if ($fechaActual->between($fechaInicio, $fechaFin)) {
                    array_push($pilaIdPropiInicio, $info->id);
                }
            }

        }

        $arrayPropiedades = PropiedadInicio::whereIn('id', $pilaIdPropiInicio)
            ->orderBy('posicion', 'ASC')
            ->get();


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

        // LUGARES INICIO
        $arrayLugarInicio = LugaresInicio::orderBy('posicion', 'ASC')->get();


        foreach ($arrayLugarInicio as $dato){

            $info = Lugares::where('id', $dato->id_lugares)->first();
            $dato->nombre = $info->nombre;
            $dato->imagen = $info->imagen;

            $listaPropi = Propiedad::where('id_lugar', $dato->id_lugares)
                ->where('visible', 1)->get();

            $conteo = 0;
            foreach ($listaPropi as $jj){

                $fechaInicio = Carbon::create($jj->fecha_inicio);
                $fechaFin = Carbon::create($jj->fecha_fin);

                // Verificar si son el mismo dia
                if($fechaInicio->equalTo($fechaFin)){

                    // solo camparar con fecha actual
                    if ($fechaActual->equalTo($fechaInicio)) {
                        $conteo++;
                    }
                }else{
                    if ($fechaActual->between($fechaInicio, $fechaFin)) {
                        $conteo++;
                    }
                }
            }

            $dato->conteo = $conteo;
        }

        // DATOS PARA PIE DE PAGINA

        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();


        // DATOS PARA MISION, VISION
        $arrayMision = Recursos2::orderBy('posicion', 'ASC')->get();

        $hayMisionActivo = false;
        foreach ($arrayMision as $dato){
            if($dato->activo == 1){
                $hayMisionActivo = true;
                break;
            }
        }


        $arraySolicitudes = Solicitudes::where('activo', 1)
            ->orderBy('posicion', 'ASC')
            ->get();


        $count = 0; // Contador para las filas en el bloque actual
        $block = []; // Array para el bloque actual

        foreach ($arraySolicitudes as $item) {

            $fechaFormat = '';
            if($item->fecha != null) {
                $fechaFormat = date("d-m-Y", strtotime($item->fecha));
            }

            $item->fechaFormat = $fechaFormat;

            // Agregar los datos del modelo al bloque actual
           /* $block[] = [
                'id' => $item->id,
                'nombre' => $item->nombre,
                'imagen' => $item->imagen,
                'fecha' => $fechaFormat
                // Agrega aquí más campos según sea necesario
            ];

            $count++; // Incrementar el contador de filas

            // Si se llega al límite de tres filas por bloque, agregar el bloque al array múltiple y reiniciar el bloque y el contador
            if ($count === 3) {
                $multiple[] = $block;
                $block = [];
                $count = 0;
            }*/
        }

        // Si hay filas restantes en el último bloque incompleto, agregarlo al array múltiple
        /*if (!empty($block)) {
            $multiple[] = $block;
        }

        $hasData = !empty($multiple);*/

        $tituloSolicitud = $infoRecursos->titulo_solicitud;


        return view('frontend.index', compact( 'arrayInicio', 'infoRecursos',
            'arrayPropiedades', 'arrayLugarInicio', 'filasRecursos', 'arrayMision', 'hayMisionActivo',
            'arraySolicitudes', 'tituloSolicitud'));
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

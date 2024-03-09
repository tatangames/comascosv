<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\InfoRecursosGet;
use App\Models\ContactoVendedor;
use App\Models\DetallesContacto;
use App\Models\EtiquetasPopulares;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\PreguntasFrecuentes;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadDetalle;
use App\Models\PropiedadEtiqueta;
use App\Models\PropiedadImagen360;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadPlanos;
use App\Models\PropiedadTag;
use App\Models\PropiedadVideos;
use App\Models\Recursos;
use App\Models\Vendedores;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Mews\Purifier\Facades\Purifier;

class FrontendRecursosController extends Controller
{

    public function vistaFaq()
    {
        $listado = PreguntasFrecuentes::orderBy('posicion', 'ASC')->get();

        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();


        return view('frontend.paginas.dudas.vistadudas', compact('listado', 'filasRecursos'));
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


        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();

        $infoRecursos = Recursos::where('id', 1)->first();

        return view('frontend.paginas.contacto.vistacontacto', compact('arrayContacto', 'filasRecursos', 'infoRecursos'));
    }

    public function vistaQuienesSomos()
    {
        $infoRecursos = Recursos::where('id', 1)->first();

        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();

        return view('frontend.paginas.acercade.vistaacercade', compact('infoRecursos', 'filasRecursos'));
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



            $precioFormat = '$' . number_format((float)$infoPropi->precio, 2, '.', ',');





            // ETIQUETAS DETALLE

            $arrayDetalle1 = PropiedadDetalle::where('id_propiedad', $infoPropi->id)
                ->where('id_tipodetalle', 1)
                ->orderBy('posicion', 'ASC')
                ->get();

            $hayAlmenos1Dato = false;

            if($arrayDetalle1 != null && $arrayDetalle1->isNotEmpty()){
                $hayAlmenos1Dato = true;
            }

            $arrayDetalle2 = PropiedadDetalle::where('id_propiedad', $infoPropi->id)
                ->where('id_tipodetalle', 2)
                ->orderBy('posicion', 'ASC')
                ->get();

            if($arrayDetalle2 != null && $arrayDetalle2->isNotEmpty()){
                $hayAlmenos1Dato = true;
            }

            // PLANOS
            $hayPlanos = false;
            $arrayPlanos = PropiedadPlanos::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->get();


            if($arrayPlanos != null && $arrayPlanos->isNotEmpty()){
                $hayPlanos = true;
            }


            // ARRAY IMAGENES 360 GRADOS
            $array360 = PropiedadImagen360::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')->get();

            $datosArray = [
                'almenos1dato' => $hayAlmenos1Dato,
                'hayplanos' => $hayPlanos
            ];

            $infoVendedor = Vendedores::where('id', $infoPropi->id_vendedor)->first();


            $arrayContactos = ContactoVendedor::where('id_vendedor', $infoPropi->id_vendedor)
                ->orderBy('posicion', 'ASC')
                ->get();

            foreach ($arrayContactos as $dato){

                $telefonoFormat = "";
                if($dato->id_tipocontacto == 1){
                    $telefonoFormat = substr_replace($dato->titulo, '-', 4, 0);
                }

                $dato->telefonoFormat = $telefonoFormat;
            }



            $arrayTagPop = PropiedadTag::where('id_propiedad', $infoPropi->id)->get();


            foreach ($arrayTagPop as $dato){
                $info = EtiquetasPopulares::where('id', $dato->id_tag_popular)->first();
                $dato->nombre = $info->nombre;
            }

            $arrayTagPopular = $arrayTagPop->sortBy('nombre')->values();


            // PROPIEDADES DEL MISMO VENDEDOR
            $arrayPropiVendedor = Propiedad::where('id_vendedor', $infoPropi->id_vendedor)
                ->where('id', '!=', $infoPropi->id)
                ->inRandomOrder()
                ->take(3)
                ->orderBy('nombre', 'ASC')
                ->get();

            foreach ($arrayPropiVendedor as $dato){

                $imagen = null;
                if($infoLista = PropiedadImagenes::where('id_propiedad', $dato->id)
                    ->orderBy('posicion', 'ASC')
                    ->first()){
                    $imagen = $infoLista->imagen;
                }
                $dato->imagen = $imagen;

                $dato->precioFormat = '$ ' . number_format((float)$dato->precio, 2, '.', ',');
            }

            // PROPIEDADES ALEATORIAS

            $arrayPropiAletorias = Propiedad::where('id', '!=', $infoPropi->id)
                ->inRandomOrder()
                ->take(3)
                ->orderBy('nombre', 'ASC')
                ->get();

            $resultsBloque = array();
            $index = 0;

            foreach ($arrayPropiAletorias as $dato){
                array_push($resultsBloque, $dato);

                $dato->precioFormat = '$'. number_format((float)$dato->precio, 2, '.', ',');

                $imagen = null;
                if($infoLista = PropiedadImagenes::where('id_propiedad', $dato->id)
                    ->orderBy('posicion', 'ASC')
                    ->first()){
                    $imagen = $infoLista->imagen;
                }
                $dato->imagen = $imagen;

                $infoVendedor = Vendedores::where('id', $dato->id_vendedor)->first();

                $dato->imagenvendedor = $infoVendedor->imagen;
                $dato->nombrevendedor = $infoVendedor->nombre;

                // listado de etiquetas principales
                $listado4Tag = Propiedad4Tag::where('id_propiedad', $dato->id)
                    ->orderBy('posicion', 'ASC')
                    ->get();

                foreach ($listado4Tag as $jj){

                    $infoImagen = PropiedadImagen4Tag::where('id', $jj->id_imagen4tag)->first();
                    $jj->imagen = $infoImagen->imagen;
                }

                $resultsBloque[$index]->detalle = $listado4Tag;
                $index++;
            }

            $datosRecursosGet = new InfoRecursosGet();
            $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();


            // LISTADO DE ETIQUETAS QUE SALEN AL INICIO
            $arrayEtiquetaInicio = Propiedad4Tag::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->get();

            foreach ($arrayEtiquetaInicio as $dato){

                $infoImg = PropiedadImagen4Tag::where('id', $dato->id_imagen4tag)->first();
                $dato->imagen = $infoImg->imagen;
            }

            $arrayEtiqPopu = PropiedadTag::where('id_propiedad', $infoPropi->id)->get();

            foreach ($arrayEtiqPopu as $dato){
                $info = EtiquetasPopulares::where('id', $dato->id_tag_popular)->first();
                $dato->nombre = $info->nombre;
            }

            $arrayEtiquetaPopular = $arrayEtiqPopu->sortBy('nombre')->values();

<<<<<<< HEAD
            $arrayPropiedadEtiquetas = PropiedadEtiqueta::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->get();

            foreach ($arrayPropiedadEtiquetas as $dato){
                $infoDato = ListadoEtiqueta::where('id', $dato->id_etiqueta)->first();
                $dato->nombre = $infoDato->nombre;
            }

=======
            $arrayPropiVideo = PropiedadVideos::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->get();
>>>>>>> 1d1080fda77c61460ba2ec9087943705649125c2

            return view('frontend.paginas.propiedadslug.vistapropiedadslug', compact('infoPropi',
                'precioFormat', 'arrayImagenes', 'arrayDetalle1', 'arrayDetalle2', 'datosArray',
                'arrayPlanos', 'array360', 'infoVendedor', 'arrayContactos', 'arrayTagPopular',
                'arrayPropiVendedor', 'arrayPropiAletorias', 'filasRecursos', 'arrayEtiquetaInicio',
<<<<<<< HEAD
                'arrayEtiquetaPopular', 'arrayPropiedadEtiquetas'));
=======
                'arrayEtiquetaPopular', 'arrayPropiVideo'));
>>>>>>> 1d1080fda77c61460ba2ec9087943705649125c2
        }else{
            return view('errors.404');
        }
    }


    public function paginaBusqueda(Request $request)
    {
        $fechaActualPuro = Carbon::now('America/El_Salvador')->toDateString();
        $fechaActual = Carbon::parse($fechaActualPuro);

        // Obtener los valores de nombre y apellido de la solicitud
        $nombre = $request->input('nombre');
        $precioMinimo = $request->input('minimo');
        $precioMaximo = $request->input('maximo');
        $formaOrdenado = $request->input('ordenado'); // trae ASC o DESC
        $ubicacion = $request->input('ubicacion');

        $precioMaximoDefecto = 20000000; // defecto 20 millones
        $hayValorMaximo = false;


        if($formaOrdenado == "ASC" || $formaOrdenado == "DESC"){
            // no hacer nada
        }else{
            // defecto ASC
            $formaOrdenado = "ASC";
        }

        if ($precioMinimo != null) {
            if ($request->filled('minimo') && !is_numeric($request->input('minimo'))) {
                $precioMinimo = 0;
            }


        }else{
           $precioMinimo = 0;
        }


        if ($precioMaximo != null) {
            if ($request->filled('maximo') && !is_numeric($request->input('maximo'))) {
                // usar el por defecto
            }else{
                if($precioMaximo != null){
                    $precioMaximoDefecto = $precioMaximo;
                }
            }
        }

        $pilaIdPropiedad = array();

        $nombreUbicacion = null;

        if($lu = Lugares::where('id', $ubicacion)->first()){
            $nombreUbicacion = $lu->nombre;
        }

        if($ubicacion != null){
            // PRIMERO OBTENER TODOS LOS VISIBLES Y EL PRECIO
            $arrayValidos = Propiedad::whereBetween('precio', [$precioMinimo, $precioMaximoDefecto])
                ->where('visible', 1)
                ->where('id_lugar', $ubicacion)
                ->get();
        }else{
            $arrayValidos = Propiedad::whereBetween('precio', [$precioMinimo, $precioMaximoDefecto])
                ->where('visible', 1)
                ->get();
        }


        foreach ($arrayValidos as $dato){

            // verificar si coincide fechas
            $fechaInicio = Carbon::parse($dato->fecha_inicio);
            $fechaFin = Carbon::parse($dato->fecha_fin);

            // Verificar si son el mismo dia
            if($fechaInicio->equalTo($fechaFin)){

                // solo camparar con fecha actual
                if ($fechaActual->equalTo($fechaInicio)) {
                    array_push($pilaIdPropiedad, $dato->id);
                }
            }else{
                if ($fechaActual->between($fechaInicio, $fechaFin)) {
                    array_push($pilaIdPropiedad, $dato->id);
                }
            }
        }


        // SI NOMBRE VIENE VACIO SE BUSCARAN  SOLO CON PRECIO

        if ($nombre != null) {

            $arrayPropiedad = DB::table('propiedad AS p')
                ->join('vendedores AS v', 'p.id_vendedor', '=', 'v.id')
                ->select( 'p.id', 'p.nombre', 'v.nombre AS nombrevendedor', 'p.slug', 'p.precio', 'p.direccion',
                'v.imagen AS imagenvendedor')
                ->whereIn('p.id', $pilaIdPropiedad)
              ->where(function($query) use ($nombre) {
                  $query->where('p.nombre', 'like', '%' . $nombre . '%')
                      ->orWhere('v.nombre', 'like', '%' . $nombre . '%');
              })
                ->orderBy('precio', $formaOrdenado)
                ->paginate(12);
        }else{

            $arrayPropiedad = DB::table('propiedad AS p')
                ->join('vendedores AS v', 'p.id_vendedor', '=', 'v.id')
                ->select( 'p.id', 'p.nombre', 'v.nombre AS nombrevendedor', 'p.slug', 'p.precio', 'p.direccion',
                    'v.imagen AS imagenvendedor')
                ->whereIn('p.id', $pilaIdPropiedad)
                ->orderBy('precio', $formaOrdenado)
                ->paginate(12);
        }


        foreach ($arrayPropiedad as $dato){

            $imagen = null;
            if($miimagen = PropiedadImagenes::where('id_propiedad', $dato->id)
                ->orderBy('posicion', 'ASC')
                ->first()){
                $imagen = $miimagen->imagen;
            }

            $dato->imagen = $imagen;
            $dato->precioFormat = '$ ' . number_format((float)$dato->precio, 2, '.', ',');
        }


        // DATOS PARA PIE DE PAGINA
        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();

        return view('frontend.paginas.busqueda.propiedadbusqueda', compact('arrayPropiedad',
        'filasRecursos', 'nombre', 'precioMinimo', 'precioMaximo', 'formaOrdenado', 'nombreUbicacion'));
    }



    public function mapaPropiedades()
    {
        $datosRecursosGet = new InfoRecursosGet();
        $filasRecursos = $datosRecursosGet->retornoDatosPiePagina();

        $apiKey = config('googleapi.ApiGoogle');
        $fechaActualPuro = Carbon::now('America/El_Salvador')->toDateString();
        $fechaActual = Carbon::parse($fechaActualPuro);
        $pilaIdPropiedad = array();
        $arrayValidos = Propiedad::where('visible', 1)->get();

<<<<<<< HEAD
        $pilaIdPropiedad = array();
        $fechaActualPuro = Carbon::now('America/El_Salvador')->toDateString();
        $fechaActual = Carbon::parse($fechaActualPuro);

        $arrayValidos = Propiedad::where('visible', 1)->get();

        foreach ($arrayValidos as $dato){

            // verificar si coincide fechas
            $fechaInicio = Carbon::parse($dato->fecha_inicio);
            $fechaFin = Carbon::parse($dato->fecha_fin);

            // Verificar si son el mismo dia
            if($fechaInicio->equalTo($fechaFin)){

                // solo camparar con fecha actual
                if ($fechaActual->equalTo($fechaInicio)) {
                    if($dato->latitud != null && $dato->longitud != null){
                        array_push($pilaIdPropiedad, $dato->id);
                    }
                }
            }else{
                if ($fechaActual->between($fechaInicio, $fechaFin)) {
                    if($dato->latitud != null && $dato->longitud != null) {
                        array_push($pilaIdPropiedad, $dato->id);
                    }
                }
            }
        }

        $marcadores = Propiedad::whereIn('id', $pilaIdPropiedad)->get();
=======
        foreach ($arrayValidos as $dato) {
>>>>>>> 1d1080fda77c61460ba2ec9087943705649125c2

            // verificar si coincide fechas
            $fechaInicio = Carbon::parse($dato->fecha_inicio);
            $fechaFin = Carbon::parse($dato->fecha_fin);

            // Verificar si son el mismo dia
            if ($fechaInicio->equalTo($fechaFin)) {

                // solo camparar con fecha actual
                if ($fechaActual->equalTo($fechaInicio)) {
                    if($dato->latitud != null && $dato->longitud != null){
                        array_push($pilaIdPropiedad, $dato->id);
                    }
                }
            } else {
                if ($fechaActual->between($fechaInicio, $fechaFin)) {
                    if($dato->latitud != null && $dato->longitud != null){
                        array_push($pilaIdPropiedad, $dato->id);
                    }
                }
            }
        }

        $marcadores = Propiedad::whereIn('id', $pilaIdPropiedad)->get();
        $conteo = Propiedad::whereIn('id', $pilaIdPropiedad)->count();

        return view('frontend.paginas.mapa.vistamapa', compact('filasRecursos', 'marcadores', 'apiKey', 'conteo'));
    }






}

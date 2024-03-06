<?php

namespace App\Http\Controllers\Backend\Propiedad;

use App\Http\Controllers\Controller;
use App\Models\EtiquetasPopulares;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadDetalle;
use App\Models\PropiedadEtiqueta;
use App\Models\PropiedadImagen360;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadInicio;
use App\Models\PropiedadPlanos;
use App\Models\PropiedadTag;
use App\Models\PropiedadTipoDetalle;
use App\Models\Vendedores;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PropiedadController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function indexPropiedad(){

        $arrayVendedor = Vendedores::orderBy('nombre', 'ASC')->get();
        $arrayLugar = Lugares::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.propiedad.vistapropiedad', compact('arrayVendedor',
        'arrayLugar'));
    }

    public function tablaPropiedad(){

        $listado = Propiedad::orderBy('nombre', 'ASC')->get();

        foreach ($listado as $dato){

            $dato->fechaFormat =  date("d-m-Y", strtotime($dato->fecha));

            if($dato->precio != null){
                $dato->precioFormat = '$' . number_format((float)$dato->precio, 2, '.', ',');
            }else{
                $dato->precioFormat = "";
            }

            $infoVendedor = Vendedores::where('id', $dato->id_vendedor)->first();
            $dato->nombreVendedor = $infoVendedor->nombre;

            $fechaInicio =  date("d-m-Y", strtotime($dato->fecha_inicio));
            $fechaFin =  date("d-m-Y", strtotime($dato->fecha_fin));

            $dato->fechaVisible = $fechaInicio . " - " . $fechaFin;
        }

        return view('backend.admin.propiedad.tablapropiedad', compact('listado'));
    }

    public function informacionPropiVendedor(Request $request){

        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Vendedores::where('id', $request->id)->first()) {

            return ['success' => 1, 'imagen' => $info->imagen];
        }else{
            return ['success' => 2];
        }
    }


    public function informacionPropiedadExtra(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Propiedad::where('id', $request->id)->first()){

            $fechainicia = date("d-m-Y", strtotime($info->fecha_inicio));
            $fechafin = date("d-m-Y", strtotime($info->fecha_fin));
            $infoVendedor = Vendedores::where('id', $info->id_vendedor)->first();

            return ['success' => 1,
                    'imagen' => $infoVendedor->imagen,
                    'fechainicio' => $fechainicia,
                    'fechafin' => $fechafin,
                    'vendedor' => $infoVendedor->nombre
                ];

        }else{
            return ['success' => 2];
        }
    }

    public function registrarPropiedad(Request $request){

        $regla = array(
            'idvendedor' => 'required',
            'nombre' => 'required',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'idlugar' => 'required',
            'slug' => 'required'
        );

        // direccion, precio, latitud, longitud, videourl

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        DB::beginTransaction();
        try {

            $slug = Str::slug($request->slug, '-');

            if(Propiedad::where('slug', $slug)->first()){
                return ['success' => 1];
            }

            $nuevo = new Propiedad();
            $nuevo->id_vendedor = $request->idvendedor;
            $nuevo->fecha = Carbon::now('America/El_Salvador');
            $nuevo->nombre = $request->nombre;
            $nuevo->direccion = $request->direccion;
            $nuevo->precio = $request->precio;
            $nuevo->fecha_inicio = $request->fechainicio;
            $nuevo->fecha_fin = $request->fechafin;
            $nuevo->latitud = $request->latitud;
            $nuevo->longitud = $request->longitud;
            $nuevo->id_lugar = $request->idlugar;
            $nuevo->vineta_derecha = null;
            $nuevo->vineta_izquierda = null;
            $nuevo->slug = $slug;
            $nuevo->video_url = $request->videourl;
            $nuevo->descripcion = null;
            $nuevo->visible = 0;
            $nuevo->save();

            DB::commit();
            return ['success' => 2];
        }catch(\Throwable $e){
            Log::info('error: ' . $e);
            DB::rollback();
            return ['success' => 99];
        }
    }


    public function informacionPropiedad(Request $request){

        $regla = array(
            'id' => 'required',
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Propiedad::where('id', $request->id)->first()){

            $infoVendedor = Vendedores::where('id', $info->id_vendedor)->first();

            $arrayVendedor = Vendedores::orderBy('nombre', 'ASC')->get();

            $arrayUbicacion = Lugares::orderBy('nombre', 'ASC')->get();

            return ['success' => 1,
                    'info' => $info,
                    'listado' => $arrayVendedor,
                    'imagen' => $infoVendedor->imagen,
                    'listadoubi' => $arrayUbicacion
                ];
        }else{
            return ['success' => 99];
        }
    }


    public function actualizarPropiedad(Request $request){

        $regla = array(
            'id' => 'required',
            'idvendedor' => 'required',
            'nombre' => 'required',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'idlugar' => 'required',
            'toggle' => 'required'
        );

        // direccion, precio, latitud, longitud, slug

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}



        // Verificar que tenga imagenes ya registradas
        // si va activar
        if($request->toggle == 1){
            if(PropiedadImagenes::where('id_propiedad', $request->id)->first()){
                // si hay imagenes
            }else{
                return ['success' => 1];
            }
        }


        $slug = Str::slug($request->slug, '-');

        if(Propiedad::where('slug', $slug)
            ->where('id', '!=', $request->id)
            ->first()){

            return ['success' => 2];
        }

        Propiedad::where('id', $request->id)
            ->update([
                'id_vendedor' => $request->idvendedor,
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'precio' => $request->precio,
                'fecha_inicio' => $request->fechainicio,
                'fecha_fin' => $request->fechafin,
                'latitud' => $request->latitud,
                'longitud' => $request->longitud,
                'id_lugar' => $request->idlugar,
                'slug' => $slug,
                'video_url' => $request->videourl,
                'visible' => $request->toggle
            ]);

        return ['success' => 3];
    }

    public function actualizarPropiedadDescripcion(Request $request){

        $regla = array(
            'id' => 'required',
        );

        // descripcion

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        Propiedad::where('id', $request->id)
            ->update([
                'descripcion' => $request->descripcion
            ]);

        return ['success' => 1];
    }


    public function actualizarPropiedadVineta(Request $request)
    {

        $regla = array(
            'id' => 'required',
        );

        // derecha, izquierda

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        Propiedad::where('id', $request->id)
            ->update([
                'vineta_izquierda' => $request->izquierda,
                'vineta_derecha' => $request->derecha,
            ]);

        return ['success' => 1];
    }


    //*********************** ETIQUETAS *************************************

    public function indexPropiedadEtiqueta($idpropi){

        $arrayEtiquetas = ListadoEtiqueta::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.propiedad.etiqueta.vistapropiedadetiqueta', compact('arrayEtiquetas', 'idpropi'));
    }

    public function tablaPropiedadEtiqueta($idpropi){

        $listado = PropiedadEtiqueta::where('id_propiedad', $idpropi)
            ->orderBy('posicion', 'ASC')
            ->get();

        foreach ($listado as $dato){
            $infoEtiqueta = ListadoEtiqueta::where('id', $dato->id_etiqueta)->first();
            $dato->nombreEtiqueta = $infoEtiqueta->nombre;
        }

        return view('backend.admin.propiedad.etiqueta.tablapropiedadetiqueta', compact('listado'));
    }


    public function registrarPropiedadEtiqueta(Request $request){

        $regla = array(
            'idpropiedad' => 'required',
            'etiqueta' => 'required',
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadEtiqueta::where('id_propiedad', $request->idpropiedad)
            ->where('id_etiqueta', $request->etiqueta)->first()){
            return ['success' => 1];
        }

        if($info = PropiedadEtiqueta::where('id_propiedad', $request->idpropiedad)
            ->orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new PropiedadEtiqueta();
        $nuevo->id_propiedad = $request->idpropiedad;
        $nuevo->id_etiqueta = $request->etiqueta;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->save();

        return ['success' => 2];
    }

    public function actualizarPosicionPropiEtiqueta(Request $request){

        $tasks = PropiedadEtiqueta::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiEtiqueta(Request $request){

        $regla = array(
            'id' => 'required',
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if($info = PropiedadEtiqueta::where('id', $request->id)->first()){

            PropiedadEtiqueta::where('id', $info->id)->delete();

            // fue borrada
            return ['success' => 1];
        }else{
            // decir que fue borrado
            return ['success' => 1];
        }
    }










    //***********************  PROPIEDAD 4 TAG  *************************************

    public function indexPropiedad4Tag($idpropi){

        $arrayImagenes = PropiedadImagen4Tag::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.propiedad.tag4.vistapropiedad4tag', compact('arrayImagenes', 'idpropi'));
    }

    public function tablaPropiedad4Tag($idpropi){

        $listado = Propiedad4Tag::where('id_propiedad', $idpropi)
            ->orderBy('posicion', 'ASC')
            ->get();

        foreach ($listado as $dato){
            $infoEtiqueta = PropiedadImagen4Tag::where('id', $dato->id_imagen4tag)->first();
            $dato->imagen = $infoEtiqueta->imagen;
        }

        return view('backend.admin.propiedad.tag4.tablapropiedad4tag', compact('listado'));
    }


    public function registrarPropiedad4Tag(Request $request){

        $regla = array(
            'nombre' => 'required',
            'idpropiedad' => 'required',
            'etiqueta' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if($info = Propiedad4Tag::where('id_propiedad', $request->idpropiedad)
            ->orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new Propiedad4Tag();
        $nuevo->id_propiedad = $request->idpropiedad;
        $nuevo->id_imagen4tag = $request->etiqueta;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->nombre = $request->nombre;
        $nuevo->save();

        return ['success' => 1];
    }

    public function actualizarPosicionPropiedad4Tag(Request $request){

        $tasks = Propiedad4Tag::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiedad4Tag(Request $request){

        $regla = array(
            'id' => 'required',
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if($info = Propiedad4Tag::where('id', $request->id)->first()){

            Propiedad4Tag::where('id', $info->id)->delete();

            // fue borrada
            return ['success' => 1];
        }else{
            // decir que fue borrado
            return ['success' => 1];
        }
    }



    // ******************** PROPIEDAD IMAGENES *****************************

    public function indexPropiedadImagenes($idpropi){

        return view('backend.admin.propiedad.imagenes.vistapropiedadimagenes', compact('idpropi'));
    }


    public function tablaPropiedadImagenes($idpropi){

        $listado = PropiedadImagenes::where('id_propiedad', $idpropi)
            ->orderBy('posicion', 'ASC')
            ->get();

        return view('backend.admin.propiedad.imagenes.tablapropiedadimagenes', compact('idpropi', 'listado'));
    }

    public function registrarPropiedadImagenes(Request $request){

        $rules = array(
            'idpropiedad' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if ($request->hasFile('imagen')) {

            $cadena = Str::random(15);
            $tiempo = microtime();
            $union = $cadena . $tiempo;
            $nombre = str_replace(' ', '_', $union);

            $extension = '.' . $request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre . strtolower($extension);
            $avatar = $request->file('imagen');
            $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

            if ($upload) {

                if($info = PropiedadImagenes::where('id_propiedad', $request->idpropiedad)
                    ->orderBy('posicion', 'DESC')->first()){
                    $nuevaPosicion = $info->posicion + 1;
                }else{
                    $nuevaPosicion = 1;
                }

                $nuevo = new PropiedadImagenes();
                $nuevo->id_propiedad = $request->idpropiedad;
                $nuevo->imagen = $nombreFoto;
                $nuevo->posicion = $nuevaPosicion;
                $nuevo->save();

                return ['success' => 1];

            } else {
                // error al subir imagen
                return ['success' => 99];
            }
        } else {
            // imagen no encontrada
            return ['success' => 99];
        }
    }


    public function actualizarPosicionPropiedadImagenes(Request $request){

        $tasks = PropiedadImagenes::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiedadImagenes(Request $request){

        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if($info = PropiedadImagenes::where('id', $request->id)->first()){

            $imagenOld = $info->imagen;

            if(Storage::disk('archivos')->exists($imagenOld)){
                Storage::disk('archivos')->delete($imagenOld);
            }

            PropiedadImagenes::where('id', $info->id)->delete();

            // fue borrada
            return ['success' => 1];
        }else{
            // decir que fue borrado
            return ['success' => 1];
        }
    }




    // ************************************** PROPIEDAD INICIO ************************************

    public function indexPropiedadInicio()
    {
        $arrayPropiedad = Propiedad::orderBy('nombre', 'ASC')->get();


        return view('backend.admin.propiedad.inicio.vistapropiinicio', compact('arrayPropiedad'));
    }

    public function tablaPropiedadInicio()
    {

        $listado = PropiedadInicio::orderBy('posicion', 'ASC')->get();

        foreach ($listado as $dato){

            $infoPropi = Propiedad::where('id', $dato->id_propiedad)->first();

            $infoVendedor = Vendedores::where('id', $infoPropi->id_vendedor)->first();
            $dato->nombreVendedor = $infoVendedor->nombre;

            $fechainicio = date("d-m-Y", strtotime($infoPropi->fecha_inicio));
            $fechafin = date("d-m-Y", strtotime($infoPropi->fecha_fin));

            $imagen = null;
            if($infoImagen = PropiedadImagenes::where('id_propiedad', $infoPropi->id)
                ->orderBy('posicion', 'ASC')
                ->take(1)
                ->first()){
                $imagen = $infoImagen->imagen;
            }

            $dato->imagen = $imagen;
            $dato->fechainicio = $fechainicio;
            $dato->fechafin = $fechafin;
            $dato->nombre = $infoPropi->nombre;
        }

        return view('backend.admin.propiedad.inicio.tablapropiinicio', compact('listado'));
    }


    public function registrarPropiedadInicio(Request $request)
    {
        $regla = array(
            'idpropiedad' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadInicio::where('id_propiedad', $request->idpropiedad)->first()){

         return ['success' => 1];
        }

        if($info = PropiedadInicio::orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new PropiedadInicio();
        $nuevo->id_propiedad = $request->idpropiedad;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->save();

        return ['success' => 2];
    }


    public function actualizarPosicionPropiedadInicio(Request $request)
    {
        $tasks = PropiedadInicio::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiedadInicio(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadInicio::where('id', $request->id)->first()){

            PropiedadInicio::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }




    // ******************** ETIQUETAS DETALLE *******************************

    public function indexEtiquetaDetalle($idpropi){

        $arrayTipoDetalle = PropiedadTipoDetalle::orderBy('id', 'ASC')->get();

        return view('backend.admin.propiedad.tipodetalle.vistatipodetalle', compact('arrayTipoDetalle', 'idpropi'));
    }

    public function tablaEtiquetaDetalle($idpropi, $idtipo){

        $listado = PropiedadDetalle::where('id_propiedad', $idpropi)
            ->where('id_tipodetalle', $idtipo)
            ->orderBy('posicion', 'ASC')
            ->get();

        if($idtipo == 1){
            return view('backend.admin.propiedad.tipodetalle.tablatipodetalle', compact('listado'));
        }

        return view('backend.admin.propiedad.tipodetalle.tablatipodetalletipo2', compact('listado'));
    }


    public function registrarPropiedadDetalle(Request $request){

        $regla = array(
            'etiqueta' => 'required',
            'idpropiedad' => 'required',
            'titulo' => 'required',
        );

        // descripcion

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = PropiedadDetalle::where('id_propiedad', $request->idpropiedad)
            ->where('id_tipodetalle', $request->etiqueta)
            ->orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        // aunque no envie descripcion, sera null

        $nuevo = new PropiedadDetalle();
        $nuevo->id_propiedad = $request->idpropiedad;
        $nuevo->id_tipodetalle = $request->etiqueta;
        $nuevo->titulo = $request->titulo;
        $nuevo->descripcion = $request->descripcion;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->save();

        return ['success' => 1];
    }

    public function actualizarPosicionPropiedadDetalle(Request $request){

        $tasks = PropiedadDetalle::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }

        return ['success' => 1];
    }


    public function borrarPropiedadDetalle(Request $request){

        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadDetalle::where('id', $request->id)->first()){

            PropiedadDetalle::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }





    // ************************************** PROPIEDAD PLANOS ************************************

    public function indexPropiedadPlanos($idpropi)
    {
        return view('backend.admin.propiedad.planos.vistaplanos', compact('idpropi'));
    }

    public function tablaPropiedadPlanos($idpropi)
    {
        $listado = PropiedadPlanos::where('id_propiedad', $idpropi)
            ->orderBy('posicion', 'ASC')
            ->get();

        return view('backend.admin.propiedad.planos.tablaplanos', compact('listado'));
    }


    public function registrarPropiedadPlanos(Request $request)
    {
        $regla = array(
            'idpropiedad' => 'required',
        );

        // imagen

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        $cadena = Str::random(15);
        $tiempo = microtime();
        $union = $cadena . $tiempo;
        $nombre = str_replace(' ', '_', $union);

        $extension = '.' . $request->imagen->getClientOriginalExtension();
        $nombreFoto = $nombre . strtolower($extension);
        $avatar = $request->file('imagen');
        $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

        if ($upload) {

            if($info = PropiedadPlanos::where('id_propiedad', $request->idpropiedad)
                ->orderBy('posicion', 'DESC')
                ->first()){
                $nuevaPosicion = $info->posicion + 1;
            }else{
                $nuevaPosicion = 1;
            }

            $nuevo = new PropiedadPlanos();
            $nuevo->id_propiedad = $request->idpropiedad;
            $nuevo->posicion = $nuevaPosicion;
            $nuevo->imagen = $nombreFoto;
            $nuevo->save();

            return ['success' => 1];

        } else {
            // error al subir imagen
            return ['success' => 99];
        }
    }


    public function actualizarPosicionPropiedadPlanos(Request $request)
    {
        $tasks = PropiedadPlanos::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiedadPlanos(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = PropiedadPlanos::where('id', $request->id)->first()){

            $imagenOld = $info->imagen;

            if(Storage::disk('archivos')->exists($imagenOld)){
                Storage::disk('archivos')->delete($imagenOld);
            }

            PropiedadPlanos::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }




    // *********************** IMAGEN 360 ************************************


    public function indexPropiedadImagen360($idpropi)
    {
        return view('backend.admin.propiedad.imagen360.vistaimagen360', compact('idpropi'));
    }

    public function tablaPropiedadImagen360($idpropi)
    {
        $listado = PropiedadImagen360::where('id_propiedad', $idpropi)
            ->orderBy('posicion', 'ASC')
            ->get();

        return view('backend.admin.propiedad.imagen360.tablaimagen360', compact('listado'));
    }


    public function registrarPropiedadImagen360(Request $request)
    {
        $regla = array(
            'idpropiedad' => 'required',
        );

        // imagen

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        $cadena = Str::random(15);
        $tiempo = microtime();
        $union = $cadena . $tiempo;
        $nombre = str_replace(' ', '_', $union);

        $extension = '.' . $request->imagen->getClientOriginalExtension();
        $nombreFoto = $nombre . strtolower($extension);
        $avatar = $request->file('imagen');
        $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

        if ($upload) {

            if($info = PropiedadImagen360::where('id_propiedad', $request->idpropiedad)
                ->orderBy('posicion', 'DESC')
                ->first()){
                $nuevaPosicion = $info->posicion + 1;
            }else{
                $nuevaPosicion = 1;
            }

            $nuevo = new PropiedadImagen360();
            $nuevo->id_propiedad = $request->idpropiedad;
            $nuevo->posicion = $nuevaPosicion;
            $nuevo->imagen = $nombreFoto;
            $nuevo->save();

            return ['success' => 1];

        } else {
            // error al subir imagen
            return ['success' => 99];
        }
    }


    public function actualizarPosicionPropiedadImagen360(Request $request)
    {
        $tasks = PropiedadImagen360::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['posicion' => $order['posicion']]);
                }
            }
        }
        return ['success' => 1];
    }


    public function borrarPropiedadImagen360(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = PropiedadImagen360::where('id', $request->id)->first()){

            $imagenOld = $info->imagen;

            if(Storage::disk('archivos')->exists($imagenOld)){
                Storage::disk('archivos')->delete($imagenOld);
            }

            PropiedadImagen360::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }




    // ---------------- PROPIEDAD TAG POPULAR ----


    public function indexTagPopular($idpropi)
    {
        $arrayTagPopular = EtiquetasPopulares::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.propiedad.tagpopular.vistatagpopular', compact('idpropi', 'arrayTagPopular'));
    }

    public function tablaTagPopular($idpropi)
    {
        $listado = PropiedadTag::where('id_propiedad', $idpropi)->get();

        foreach ($listado as $dato){

            $infoFila = EtiquetasPopulares::where('id', $dato->id_tag_popular)->first();
            $dato->nombre = $infoFila->nombre;
        }

        return view('backend.admin.propiedad.tagpopular.tablatagpopular', compact('listado'));
    }


    public function registrarTagPopular(Request $request)
    {
        $regla = array(
            'idpropiedad' => 'required',
            'idtag' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadTag::where('id_propiedad', $request->idpropiedad)
            ->where('id_tag_popular', $request->idtag)->first()){
           return ['success' => 1];
        }

        $nuevo = new PropiedadTag();
        $nuevo->id_propiedad = $request->idpropiedad;
        $nuevo->id_tag_popular = $request->idtag;
        $nuevo->save();

        return ['success' => 2];
    }

    public function borrarTagPopular(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(PropiedadTag::where('id', $request->id)->first()){

            PropiedadTag::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }





}

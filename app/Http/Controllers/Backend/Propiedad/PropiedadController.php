<?php

namespace App\Http\Controllers\Backend\Propiedad;

use App\Http\Controllers\Controller;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadEtiqueta;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
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
            'idlugar' => 'required'
        );

        // direccion, precio, latitud, longitud, slug

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        $slug = Str::slug($request->slug, '-');

        if(Propiedad::where('slug', $slug)
            ->where('id', '!=', $request->id)
            ->first()){

            return ['success' => 1];
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
                'video_url' => $request->videourl
            ]);

        return ['success' => 2];
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


}

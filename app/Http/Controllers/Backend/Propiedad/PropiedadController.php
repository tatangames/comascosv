<?php

namespace App\Http\Controllers\Backend\Propiedad;

use App\Http\Controllers\Controller;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\Propiedad;
use App\Models\PropiedadEtiqueta;
use App\Models\Vendedores;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        DB::beginTransaction();
        try {

            $nuevo = new Propiedad();
            $nuevo->id_vendedor = $request->idvendedor;
            $nuevo->fecha = Carbon::now('America/El_Salvador');
            $nuevo->nombre = $request->nombre;
            $nuevo->direccion = $request->direccion;
            $nuevo->precio = $request->precio;
            $nuevo->fecha_inicio = $request->fechainicio;
            $nuevo->fecha_fin = $request->fechafin;
            $nuevo->save();

            DB::commit();
            return ['success' => 1];
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

            return ['success' => 1,
                    'info' => $info,
                    'listado' => $arrayVendedor,
                    'imagen' => $infoVendedor->imagen,
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
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        Propiedad::where('id', $request->id)
            ->update([
                'id_vendedor' => $request->idvendedor,
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'precio' => $request->precio,
                'fecha_inicio' => $request->fechainicio,
                'fecha_fin' => $request->fechafin,
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





}

<?php

namespace App\Http\Controllers\Backend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\PreguntasFrecuentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RecursosController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }


    public function indexPreguntasFrecuentes()
    {
        return view('backend.admin.recursos.preguntasfrecuentes.vistapreguntasfrecuentes');
    }

    public function tablaPreguntasFrecuentes()
    {
        $listado = PreguntasFrecuentes::orderBy('posicion', 'ASC')->get();

        return view('backend.admin.recursos.preguntasfrecuentes.tablapreguntasfrecuentes', compact('listado'));
    }


    public function preguntasFrecuentesPosicion(Request $request)
    {
        $tasks = PreguntasFrecuentes::all();

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


    public function registrarPreguntasFrecuentes(Request $request)
    {
        $regla = array(
            'titulo' => 'required',
            'descripcion' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        DB::beginTransaction();
        try {

            if($info = PreguntasFrecuentes::orderBy('posicion', 'DESC')->first()){
                $nuevaPosicion = $info->posicion + 1;
            }else{
                $nuevaPosicion = 1;
            }

            $nuevo = new PreguntasFrecuentes();
            $nuevo->titulo = $request->titulo;
            $nuevo->descripcion = $request->descripcion;
            $nuevo->posicion = $nuevaPosicion;
            $nuevo->save();


            DB::commit();
            return ['success' => 1];
        }catch(\Throwable $e){
            Log::info('error: ' . $e);
            DB::rollback();
            return ['success' => 99];
        }
    }


    public function informacionPreguntasFrecuentes(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = PreguntasFrecuentes::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 2];
        }
    }


    public function actualizarPreguntasFrecuentes(Request $request)
    {
        $regla = array(
            'id' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        PreguntasFrecuentes::where('id', $request->id)->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        return ['success' => 1];
    }



}

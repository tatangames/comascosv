<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Propiedad;
use App\Models\Vendedores;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EditorDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function indexDashboard(){

        $pilaIdPropiedad = array();

        // TOTAL DE PROPIEDADES ACTIVAS
        $arrayValidos = Propiedad::where('visible', 1)->get();

        $fechaActualPuro = Carbon::now('America/El_Salvador')->toDateString();
        $fechaActual = Carbon::parse($fechaActualPuro);

        foreach ($arrayValidos as $dato) {

            // verificar si coincide fechas
            $fechaInicio = Carbon::parse($dato->fecha_inicio);
            $fechaFin = Carbon::parse($dato->fecha_fin);

            // Verificar si son el mismo dia
            if ($fechaInicio->equalTo($fechaFin)) {

                // solo camparar con fecha actual
                if ($fechaActual->equalTo($fechaInicio)) {
                    array_push($pilaIdPropiedad, $dato->id);
                }
            } else {
                if ($fechaActual->between($fechaInicio, $fechaFin)) {
                    array_push($pilaIdPropiedad, $dato->id);
                }
            }
        }

        $conteoPropiedad = Propiedad::whereIn('id', $pilaIdPropiedad)->count();

        $conteoVendedores = Vendedores::count();

        return view('backend.admin.dashboard.editor.vistadashboardeditor', compact('conteoPropiedad', 'conteoVendedores'));
    }
}

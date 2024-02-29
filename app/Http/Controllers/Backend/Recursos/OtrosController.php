<?php

namespace App\Http\Controllers\Backend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Recursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtrosController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function indexOtros()
    {
        $infoRecursos = Recursos::where('id', 1)->first();

        return view('backend.admin.recursos.otros.vistaotrosrecursos', compact('infoRecursos'));
    }

    public function actualizarOtrosRecursos(Request $request)
    {
        $rules = array(
            'texto' => 'required',
        );

        // telefono

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        Recursos::where('id', 1)->update([
            'quienes_somos' => $request->texto,
            'telefono' => $request->telefono
        ]);

        return ['success' => 1];
    }

}

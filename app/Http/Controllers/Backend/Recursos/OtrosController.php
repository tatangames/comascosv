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

        // telefono, descripcion, textocontacto

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        Recursos::where('id', 1)->update([
            'quienes_somos' => $request->texto,
            'telefono' => $request->telefono,
            'descripcion_pagina' => $request->descripcion,
            'texto_contacto' => $request->textocontacto
        ]);

        return ['success' => 1];
    }



    public function indexRedesFooter()
    {
        $infoRecursos = Recursos::where('id', 1)->first();

        return view('backend.admin.redes.vistaredesfooter', compact('infoRecursos'));
    }


    public function actualizarRedesFooter(Request $request)
    {
        Recursos::where('id', 1)->update([
            'url_youtube' => $request->youtube,
            'url_facebook' => $request->facebook,
        ]);

        return ['success' => 1];
    }


    public function indexResponsabilidad()
    {

        $infoRecursos = Recursos::where('id', 1)->first();

        return view('backend.admin.recursos.responsabilidad.vistaresponsabilidad', compact('infoRecursos'));
    }


    public function actualizarResponsabilidad(Request $request)
    {
        $rules = array(
            'titulo' => 'required',
        );

        // texto

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        Recursos::where('id', 1)->update([
            'responsabilidad_titulo' => $request->titulo,
            'responsabilidad_mensaje' => $request->texto,
        ]);

        return ['success' => 1];
    }




}

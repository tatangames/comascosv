<?php

namespace App\Http\Controllers\Backend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\ContactoVendedor;
use App\Models\DetallesContacto;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\PreguntasFrecuentes;
use App\Models\PresentacionInicio;
use App\Models\PropiedadEtiqueta;
use App\Models\PropiedadImagen4Tag;
use App\Models\Recursos;
use App\Models\TipoContactoVendedor;
use App\Models\TiposContactos;
use App\Models\Vendedores;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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





    //************************ VENDEDORES **************************************




    public function indexVendedores()
    {
        return view('backend.admin.recursos.vendedores.vistavendedor');
    }


    public function tablaVendedores()
    {
        $listado = Vendedores::orderBy('id', 'ASC')->get();

        foreach ($listado as $dato){
            $dato->fechaFormat =  date("d-m-Y", strtotime($dato->fecha));
        }

        return view('backend.admin.recursos.vendedores.tablavendedor', compact('listado'));
    }


    public function registrarVendedor(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // telefono, correo, urlyoutube, imagen

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

                $nuevo = new Vendedores();
                $nuevo->nombre = $request->nombre;
                $nuevo->imagen = $nombreFoto;
                $nuevo->telefono = $request->telefono;
                $nuevo->correo = $request->correo;
                $nuevo->url_youtube = $request->urlyoutube;
                $nuevo->fecha = Carbon::now('America/El_Salvador');
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


    public function informacionVendedor(Request $request){

        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if($info = Vendedores::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }


    public function actualizarVendedor(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // telefono, correo, urlyoutube, imagen

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if ($request->hasFile('imagen')) {

            $infoVendedor = Vendedores::where('id', $request->id)->first();

            $imagenOld = $infoVendedor->imagen;

            $cadena = Str::random(15);
            $tiempo = microtime();
            $union = $cadena . $tiempo;
            $nombre = str_replace(' ', '_', $union);

            $extension = '.' . $request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre . strtolower($extension);
            $avatar = $request->file('imagen');
            $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

            if ($upload) {

                Vendedores::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'imagen' => $nombreFoto,
                        'telefono' => $request->telefono,
                        'correo' => $request->correo,
                        'url_youtube' => $request->urlyoutube,
                    ]);

                if(Storage::disk('archivos')->exists($imagenOld)){
                    Storage::disk('archivos')->delete($imagenOld);
                }


                return ['success' => 1];
            } else {
                // error al subir imagen
                return ['success' => 99];
            }
        } else {
            Vendedores::where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'telefono' => $request->telefono,
                    'correo' => $request->correo,
                    'url_youtube' => $request->urlyoutube,
                ]);

            return ['success' => 1];
        }
    }



    // ************************ CONTACTO PARA VENDEDOR ***********************************************

    public function indexVendedorContacto($idvendedor){

        $arrayTipo = TipoContactoVendedor::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.recursos.vendedores.contacto.vistacontacto', compact('arrayTipo', 'idvendedor'));
    }

    public function tablavendedorcontacto($idvendedor){

        $listado = ContactoVendedor::where('id_vendedor', $idvendedor)
            ->orderBy('posicion', 'ASC')
            ->get();

        foreach ($listado as $dato){

            $infoContacto = TipoContactoVendedor::where('id', $dato->id_tipocontacto)->first();

            $dato->tipo = $infoContacto->nombre;
        }

        return view('backend.admin.recursos.vendedores.contacto.tablacontacto', compact('listado'));
    }


    public function registrarvendedorcontacto(Request $request){

        $regla = array(
            'nombre' => 'required',
            'idvendedor' => 'required',
            'etiqueta' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = ContactoVendedor::where('id_vendedor', $request->idvendedor)
            ->orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new ContactoVendedor();
        $nuevo->id_vendedor = $request->idvendedor;
        $nuevo->id_tipocontacto = $request->etiqueta;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->titulo = $request->nombre;
        $nuevo->save();

        return ['success' => 1];
    }

    public function actualizarPosicionVendedorContacto(Request $request){

        $tasks = ContactoVendedor::all();

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


    public function borrarVendedorContacto(Request $request){

        $regla = array(
            'id' => 'required',
        );

        // direccion, precio

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if($info = ContactoVendedor::where('id', $request->id)->first()){

            ContactoVendedor::where('id', $info->id)->delete();

            // fue borrada
            return ['success' => 1];
        }else{
            // decir que fue borrado
            return ['success' => 1];
        }
    }

















    // ******************* ETIQUETAS *************************

    public function indexEtiquetas()
    {
        return view('backend.admin.recursos.etiquetas.vistaetiquetas');
    }


    public function tablaEtiquetas()
    {
        $listado = ListadoEtiqueta::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.recursos.etiquetas.tablaetiquetas', compact('listado'));
    }


    public function registrarEtiquetas(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        $nuevo = new ListadoEtiqueta();
        $nuevo->nombre = $request->nombre;
        $nuevo->save();

        return ['success' => 1];
    }


    public function informacionEtiquetas(Request $request){

        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if($info = ListadoEtiqueta::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }


    public function actualizarEtiquetas(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        ListadoEtiqueta::where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
            ]);

        return ['success' => 1];
    }




  // ******************* LUGARES *************************

    public function indexLugares()
    {
        return view('backend.admin.recursos.lugares.vistalugares');
    }


    public function tablaLugares()
    {
        $listado = Lugares::orderBy('nombre', 'ASC')->get();
        return view('backend.admin.recursos.lugares.tablalugares', compact('listado'));
    }


    public function registrarLugares(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // imagen

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

                $nuevo = new Lugares();
                $nuevo->nombre = $request->nombre;
                $nuevo->imagen = $nombreFoto;
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


    public function informacionLugares(Request $request){

        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if($info = Lugares::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }


    public function actualizarLugares(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // imagen

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if ($request->hasFile('imagen')) {

            $infoLugar = Lugares::where('id', $request->id)->first();

            $imagenOld = $infoLugar->imagen;

            $cadena = Str::random(15);
            $tiempo = microtime();
            $union = $cadena . $tiempo;
            $nombre = str_replace(' ', '_', $union);

            $extension = '.' . $request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre . strtolower($extension);
            $avatar = $request->file('imagen');
            $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

            if ($upload) {

                Lugares::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'imagen' => $nombreFoto,
                    ]);

                if(Storage::disk('archivos')->exists($imagenOld)){
                    Storage::disk('archivos')->delete($imagenOld);
                }

                return ['success' => 1];
            } else {
                // error al subir imagen
                return ['success' => 99];
            }
        } else {
            Lugares::where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                ]);

            return ['success' => 1];
        }
    }









    //******************************* DETALLE DE CONTACTO *****************************************

    public function indexDetalleContacto(){
        return view('backend.admin.paginas.detallecontacto.vistadetallecontacto');
    }

    public function tablaDetalleContacto(){

        $listado = DetallesContacto::orderBy('posicion', 'ASC')->get();

        foreach ($listado as $dato){

            $infoTipo = TiposContactos::where('id', $dato->id_tipos_contactos)->first();
            $dato->tipo = $infoTipo->nombre;
        }

        return view('backend.admin.paginas.detallecontacto.tabladetallecontacto', compact('listado'));
    }


    public function detalleContactoPosicion(Request $request)
    {
        $tasks = DetallesContacto::all();

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


    public function informacionDetalleContacto(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = DetallesContacto::where('id', $request->id)->first()){

            $arrayTipos = TiposContactos::orderBy('nombre', 'ASC')->get();

            return ['success' => 1, 'info' => $info,
                    'listado' => $arrayTipos
                ];
        }else{
            return ['success' => 2];
        }
    }


    public function actualizarDetalleContacto(Request $request)
    {
        $regla = array(
            'id' => 'required',
            'idtipo' => 'required',
            'descripcion' => 'required',
            'toggle' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        DetallesContacto::where('id', $request->id)->update([
            'id_tipos_contactos' => $request->idtipo,
            'nombre' => $request->descripcion,
            'visible' => $request->toggle
        ]);

        return ['success' => 1];
    }



    // ************************** PRESENTACION DE INICIO *******************************

    public function indexPresentacionInicio(){
        return view('backend.admin.paginas.presentacioninicio.vistapresentacioninicio');
    }

    public function tablaPresentacionInicio(){

        $listado = PresentacionInicio::orderBy('posicion', 'ASC')->get();

        foreach ($listado as $dato){


        }

        return view('backend.admin.paginas.presentacioninicio.tablapresentacioninicio', compact('listado'));
    }


    public function informacionPresentacionInicio(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = PresentacionInicio::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 2];
        }
    }


    public function presentacionInicioPosicion(Request $request)
    {
        $tasks = PresentacionInicio::all();

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

    public function actualizarPresentacionInicio(Request $request)
    {
        $regla = array(
            'id' => 'required',
            'titulo' => 'required',
            'descripcion' => 'required',
        );

        // imagen

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        if ($request->hasFile('imagen')) {

            $infoPresentacion = PresentacionInicio::where('id', $request->id)->first();

            $imagenOld = $infoPresentacion->imagen;

            $cadena = Str::random(15);
            $tiempo = microtime();
            $union = $cadena . $tiempo;
            $nombre = str_replace(' ', '_', $union);

            $extension = '.' . $request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre . strtolower($extension);
            $avatar = $request->file('imagen');
            $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

            if ($upload) {

                PresentacionInicio::where('id', $request->id)
                    ->update([
                        'titulo' => $request->titulo,
                        'descripcion' => $request->descripcion,
                        'imagen' => $nombreFoto,
                    ]);

                if(Storage::disk('archivos')->exists($imagenOld)){
                    Storage::disk('archivos')->delete($imagenOld);
                }

                return ['success' => 1];
            } else {
                // error al subir imagen
                return ['success' => 99];
            }
        } else {
            PresentacionInicio::where('id', $request->id)
                ->update([
                    'titulo' => $request->titulo,
                    'descripcion' => $request->descripcion,
                ]);

            return ['success' => 1];
        }
    }




    // ******************** IMAGENES 4 TAG *****************************************



    // ******************* LUGARES *************************

    public function indexImagen4Tag()
    {
        return view('backend.admin.recursos.imagen4tag.vistaimagen4tag');
    }


    public function tablaImagen4Tag()
    {
        $listado = PropiedadImagen4Tag::orderBy('nombre', 'ASC')->get();
        return view('backend.admin.recursos.imagen4tag.tablaimagen4tag', compact('listado'));
    }


    public function registrarImagen4Tag(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // imagen

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

                $nuevo = new PropiedadImagen4Tag();
                $nuevo->nombre = $request->nombre;
                $nuevo->imagen = $nombreFoto;
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


    public function informacionImagen4Tag(Request $request){

        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if($info = PropiedadImagen4Tag::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }


    public function actualizarImagen4Tag(Request $request){

        $rules = array(
            'nombre' => 'required',
        );

        // imagen

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if ($request->hasFile('imagen')) {

            $infoLugar = PropiedadImagen4Tag::where('id', $request->id)->first();

            $imagenOld = $infoLugar->imagen;

            $cadena = Str::random(15);
            $tiempo = microtime();
            $union = $cadena . $tiempo;
            $nombre = str_replace(' ', '_', $union);

            $extension = '.' . $request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre . strtolower($extension);
            $avatar = $request->file('imagen');
            $upload = Storage::disk('archivos')->put($nombreFoto, \File::get($avatar));

            if ($upload) {

                PropiedadImagen4Tag::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'imagen' => $nombreFoto,
                    ]);

                if(Storage::disk('archivos')->exists($imagenOld)){
                    Storage::disk('archivos')->delete($imagenOld);
                }

                return ['success' => 1];
            } else {
                // error al subir imagen
                return ['success' => 99];
            }
        } else {
            PropiedadImagen4Tag::where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                ]);

            return ['success' => 1];
        }
    }











}

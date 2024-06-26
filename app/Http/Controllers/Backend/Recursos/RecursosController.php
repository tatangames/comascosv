<?php

namespace App\Http\Controllers\Backend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\ContactoVendedor;
use App\Models\DescripcionPiePagina;
use App\Models\DetallesContacto;
use App\Models\EtiquetasPopulares;
use App\Models\ListadoEtiqueta;
use App\Models\Lugares;
use App\Models\LugaresInicio;
use App\Models\PreguntasFrecuentes;
use App\Models\PresentacionInicio;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadDetalle;
use App\Models\PropiedadEtiqueta;
use App\Models\PropiedadImagen360;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadInicio;
use App\Models\PropiedadItem;
use App\Models\PropiedadPlanos;
use App\Models\PropiedadTag;
use App\Models\PropiedadVideos;
use App\Models\Recursos;
use App\Models\Recursos2;
use App\Models\Solicitudes;
use App\Models\TipoContactoVendedor;
use App\Models\TiposContactos;
use App\Models\TituloPiePagina;
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


    public function borrarVendedor(Request $request)
    {

        $rules = array(
            'id' => 'required', // id vendedor
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        DB::beginTransaction();
        try {


            $pilaIdPropiedad = array();

            $listaPro = Propiedad::where('id_vendedor', $request->id)->get();

            foreach ($listaPro as $dato){
                array_push($pilaIdPropiedad, $dato->id);
            }


            // ELIMINAR VIDEOS
            PropiedadVideos::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR PROPIEDAD TAG
            PropiedadTag::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR IMAGEN 360
            PropiedadImagen360::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR PLANOS
            PropiedadPlanos::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR DETALLE
            PropiedadDetalle::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR IMAGENES
            $arrayImagenes = PropiedadImagenes::whereIn('id_propiedad', $pilaIdPropiedad)->get();

            foreach ($arrayImagenes as $dato){

                if($dato->imagen != null) {
                    if (Storage::disk('archivos')->exists($dato->imagen)) {
                        Storage::disk('archivos')->delete($dato->imagen);
                    }
                }

            }

            PropiedadImagenes::whereIn('id_propiedad', $pilaIdPropiedad)->delete();


            // ELIMINAR 4 TAG
            Propiedad4Tag::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR DE PROPIEDAD INICIO
            PropiedadInicio::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR ITEM
            PropiedadItem::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR ETIQUETA
            PropiedadEtiqueta::whereIn('id_propiedad', $pilaIdPropiedad)->delete();

            // ELIMINAR PROPIEDAD
            Propiedad::whereIn('id', $pilaIdPropiedad)->delete();



            ContactoVendedor::where('id_vendedor', $request->id)->delete();

            Vendedores::where('id', $request->id)->delete();

            DB::commit();

            return ['success' => 1];
        }catch(\Throwable $e){
            Log::info('error: ' . $e);
            DB::rollback();
            return ['success' => 99];
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
                $nuevo->visible = 1;
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
            'toggle' => 'required'
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
                        'visible' => $request->toggle
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
                    'visible' => $request->toggle
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



    // ************************* LUGARES INICIO *******************************


    public function indexLugaresInicio()
    {
        $arrayLugares = Lugares::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.recursos.lugaresinicio.vistalugarinicio', compact('arrayLugares'));
    }


    public function tablaLugaresInicio()
    {
        $listado = LugaresInicio::orderBy('posicion', 'ASC')->get();

        foreach ($listado as $dato){
            $info = Lugares::where('id', $dato->id_lugares)->first();
            $dato->nombre = $info->nombre;
        }

        return view('backend.admin.recursos.lugaresinicio.tablalugarinicio', compact('listado'));
    }


    public function registrarLugaresInicio(Request $request){

        $rules = array(
            'idlugar' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if(LugaresInicio::where('id_lugares', $request->idlugar)->first()){
            return ['success' => 1];
        }

        if($info = LugaresInicio::orderBy('posicion', 'DESC')->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new LugaresInicio();
        $nuevo->id_lugares = $request->idlugar;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->save();

        return ['success' => 2];
    }

    public function actualizarPosicionLugaresInicio(Request $request){

        $tasks = LugaresInicio::all();

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


    public function borrarLugaresInicio(Request $request){

        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(LugaresInicio::where('id', $request->id)->first()){

            LugaresInicio::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }


    //************************ PIE DE PAGINA **********************************


    public function indexPiePagina(){

        $dato1 = TituloPiePagina::where('id', 1)->first();
        $columna1 = $dato1->titulo;
        $dato2 = TituloPiePagina::where('id', 2)->select('titulo')->first();
        $columna2 = $dato2->titulo;

        return view('backend.admin.paginas.piepagina.vistatitulopiepagina', compact('columna1',
            'columna2'));
    }


    public function actualizarColumnas(Request $request){

        $regla = array(
            'columna1' => 'required',
            'columna2' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        TituloPiePagina::where('id', 1)->update([
            'titulo' => $request->columna1,
        ]);

        TituloPiePagina::where('id', 2)->update([
            'titulo' => $request->columna2,
        ]);

        return ['success' => 1];
    }


    // PUEDE SER COLUMNA ID 1 O ID 2
    public function indexPieColumnasFila($idfila){

        return view('backend.admin.paginas.piepagina.vistacolumnafila', compact('idfila'));
    }


    public function tablaPieColumnasFila($idfila){

        $listado = DescripcionPiePagina::where('id_titulopiepagina', $idfila)
            ->orderBy('posicion', 'ASC')
            ->get();

        return view('backend.admin.paginas.piepagina.tablacolumnafila', compact('listado'));
    }






    public function actualizarPosicionColumnaFila(Request $request){

        $tasks = DescripcionPiePagina::all();

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


    public function borrarColumnaFila(Request $request){

        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if(DescripcionPiePagina::where('id', $request->id)->first()){

            DescripcionPiePagina::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }


    public function registrarFilaColumna(Request $request){
        $regla = array(
            'id' => 'required', // puede ser ID 1 o 2
            'nombre' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = DescripcionPiePagina::where('id_titulopiepagina', $request->id)
            ->orderBy('posicion', 'DESC')
            ->first()){
            $nuevaPosicion = $info->posicion + 1;
        }else{
            $nuevaPosicion = 1;
        }

        $nuevo = new DescripcionPiePagina();
        $nuevo->id_titulopiepagina = $request->id;
        $nuevo->nombre = $request->nombre;
        $nuevo->posicion = $nuevaPosicion;
        $nuevo->save();

        return ['success' => 1];
    }


    public function informacionFilaColumna(Request $request){
        $regla = array(
            'id' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = DescripcionPiePagina::where('id', $request->id)->first()){


            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }

    public function actualizarFilaColumna(Request $request){

        $regla = array(
            'id' => 'required',
            'nombre' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        DescripcionPiePagina::where('id', $request->id)->update([
            'nombre' => $request->nombre,
        ]);

        return ['success' => 1];
    }




    // ******************************* ETIQUETAS POPULARES ******************************


    public function indexTagPopular(){

        return view('backend.admin.recursos.etiquetapopular.vistatagpopular');
    }

    public function tablaTagPopular(){

        $listado = EtiquetasPopulares::orderBy('nombre', 'ASC')->get();

        return view('backend.admin.recursos.etiquetapopular.tablatagpopular', compact('listado'));
    }



    public function registrarTagPopular(Request $request){
        $regla = array(
            'nombre' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        $nuevo = new EtiquetasPopulares();
        $nuevo->nombre = $request->nombre;
        $nuevo->save();

        return ['success' => 1];
    }


    public function informacionTagPopular(Request $request){
        $regla = array(
            'id' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = EtiquetasPopulares::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 99];
        }
    }

    public function actualizarTagPopular(Request $request){

        $regla = array(
            'id' => 'required',
            'nombre' => 'required'
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        EtiquetasPopulares::where('id', $request->id)->update([
            'nombre' => $request->nombre,
        ]);

        return ['success' => 1];
    }




    // ************************** VISION Y MISION *******************************

    public function indexVision(){
        return view('backend.admin.mision.vistamision');
    }

    public function tablaVision(){

        $listado = Recursos2::orderBy('posicion', 'ASC')->get();

        return view('backend.admin.mision.tablamision', compact('listado'));
    }


    public function informacionVision(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Recursos2::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 2];
        }
    }


    public function presentacionVisionPosicion(Request $request)
    {
        $tasks = Recursos2::all();

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

    public function actualizarVisionInicio(Request $request)
    {
        $regla = array(
            'id' => 'required',
            'toggle' => 'required'
        );


        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        Recursos2::where('id', $request->id)
            ->update([
                'titulo' => $request->titulo,
                'mensaje' => $request->descripcion,
                'activo' => $request->toggle
            ]);

        return ['success' => 1];
    }



    // ************* VISTA DE SOLICITUDES *******************************


    public function indexSolicitudes(){

        $infoRe = Recursos::where('id', 1)->first();


        return view('backend.admin.recursos.solicitudes.vistasolicitudes', compact('infoRe'));
    }

    public function tablaSolicitudes(){

        $listado = Solicitudes::orderBy('posicion', 'ASC')->get();

        foreach ($listado as $dato){

            $fechaFormat = '';
            if($dato->fecha != null){
                $fechaFormat = date("d-m-Y", strtotime($dato->fecha));
            }

            $dato->fechaFormat = $fechaFormat;
        }

        return view('backend.admin.recursos.solicitudes.tablasolicitudes', compact('listado'));
    }


    public function registrarSolicitudes(Request $request)
    {
        $regla = array(
            'nombre' => 'required',
        );

        // imagen, fecha

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

            if($info = Solicitudes::orderBy('posicion', 'DESC')->first()){
                $nuevaPosicion = $info->posicion + 1;
            }else{
                $nuevaPosicion = 1;
            }

            $nuevo = new Solicitudes();
            $nuevo->nombre = $request->nombre;
            $nuevo->posicion = $nuevaPosicion;
            $nuevo->imagen = $nombreFoto;
            $nuevo->fecha = $request->fecha;
            $nuevo->activo = 1;
            $nuevo->save();

            return ['success' => 1];

        } else {
            // error al subir imagen
            return ['success' => 99];
        }
    }


    public function infoSolicitudes(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Solicitudes::where('id', $request->id)->first()){

            return ['success' => 1, 'info' => $info];
        }else{
            return ['success' => 2];
        }
    }


    public function posicionSolicitudes(Request $request)
    {
        $tasks = Solicitudes::all();

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


    public function actualizarSolicitudes(Request $request){

        $rules = array(
            'nombre' => 'required',
            'toggle' => 'required'
        );

        // imagen, fecha

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['success' => 0];
        }

        if ($request->hasFile('imagen')) {

            $infoLugar = Solicitudes::where('id', $request->id)->first();

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

                Solicitudes::where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'imagen' => $nombreFoto,
                        'activo' => $request->toggle,
                        'fecha' => $request->fecha
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
            Solicitudes::where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'activo' => $request->toggle,
                    'fecha' => $request->fecha
                ]);

            return ['success' => 1];
        }
    }



    public function borrarSolicitudes(Request $request)
    {
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}

        if($info = Solicitudes::where('id', $request->id)->first()){

            $imagenOld = $info->imagen;

            if(Storage::disk('archivos')->exists($imagenOld)){
                Storage::disk('archivos')->delete($imagenOld);
            }

            Solicitudes::where('id', $request->id)->delete();

            return ['success' => 1];
        }else{
            return ['success' => 1];
        }
    }


    public function actualizarSolicitudesTitulo(Request $request){

        $regla = array(
            'titulo' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0];}


        Recursos::where('id', 1)
            ->update([
                'titulo_solicitud' => $request->titulo,
            ]);

        return ['success' => 1];
    }



}

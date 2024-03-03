<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use App\Models\ContactoVendedor;
use App\Models\DetallesContacto;
use App\Models\PreguntasFrecuentes;
use App\Models\Propiedad;
use App\Models\Propiedad4Tag;
use App\Models\PropiedadDetalle;
use App\Models\PropiedadImagen360;
use App\Models\PropiedadImagen4Tag;
use App\Models\PropiedadImagenes;
use App\Models\PropiedadPlanos;
use App\Models\PropiedadTag;
use App\Models\Recursos;
use App\Models\Vendedores;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Mews\Purifier\Facades\Purifier;

class FrontendRecursosController extends Controller
{

    public function vistaFaq()
    {
        $listado = PreguntasFrecuentes::orderBy('posicion', 'ASC')->get();


        return view('frontend.paginas.dudas.vistadudas', compact('listado'));
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

        return view('frontend.paginas.contacto.vistacontacto', compact('arrayContacto'));
    }

    public function vistaQuienesSomos()
    {
        $infoRecursos = Recursos::where('id', 1)->first();

        return view('frontend.paginas.acercade.vistaacercade', compact('infoRecursos'));
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

            $precioFormat = '$ ' . number_format((float)$infoPropi->precio, 2, '.', ',');


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

            $arrayTagPopular = PropiedadTag::where('id_propiedad', $infoPropi->id)
                ->orderBy('nombre', 'ASC')
                ->get();


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

                $dato->precioFormat = number_format((float)$dato->precio, 2, '.', ',');

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


            return view('frontend.paginas.propiedadslug.vistapropiedadslug', compact('infoPropi',
                'precioFormat', 'arrayImagenes', 'arrayDetalle1', 'arrayDetalle2', 'datosArray',
                'arrayPlanos', 'array360', 'infoVendedor', 'arrayContactos', 'arrayTagPopular',
                'arrayPropiVendedor', 'arrayPropiAletorias'));
        }else{
            return view('errors.404');
        }


    }



}

<?php

namespace App\Http\Controllers\Controles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlRolController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function indexRedireccionamiento(){

        $user = Auth::user();

        // ADMINISTRADOR
        if($user->hasRole('admin')){
            $ruta = 'admin.roles.index';
        }
        else if($user->hasRole('editor')){
            $ruta = 'editor.dashboard.index';
        }
        else if($user->hasRole('cliente')){
            $ruta = 'cliente.dashboard.index';
        }
        else{
            $ruta = 'no.permisos.index';
        }

        return view('backend.index', compact( 'ruta', 'user'));
    }

    public function indexSinPermiso(){
        return view('errors.403');
    }
}

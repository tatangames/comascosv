<?php

namespace App\Http\Controllers\Frontend\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function indexIniciarSesion(){

        if (Auth::guard('admin')->check()) {
            return redirect('/panel');
        }

        // para la plantilla
        $tipoBody = 2;

        return view('frontend.paginas.login.vistalogin', compact('tipoBody'));
    }


    public function login(Request $request){

        $rules = array(
            'usuario' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails()){
            return ['success' => 0];
        }

        $credentials = request()->only('usuario', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return ['success'=> 1, 'ruta'=> route('admin.panel')];
        } else {
            return ['success' => 2];
        }
    }


    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}

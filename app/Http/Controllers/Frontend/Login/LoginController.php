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

    public function index(){

        /*if (Auth::guard('admin')->check()) {
            return "ya iniciado sesion";
        }else{
            return "mmm";
        }*/

        return view('frontend.login.vistalogin');
    }


    public function login(Request $request){

        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails()){
            return ['success' => 0];
        }

        $credentials = request()->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            //return redirect()->route('admin.index');
            return ['success'=> 1, 'ruta'=> route('admin.panel')];
        } else {
            return ['success' => 2];
        }
    }
}

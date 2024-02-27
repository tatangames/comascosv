<?php

namespace App\Http\Controllers\Frontend\Recursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function vistaInicio()
    {

        $tipoBody = 1;

        return view('frontend.index', compact('tipoBody'));
    }


    public function vistaLogin()
    {

        // reidireccionar si ya inicio sesion
        if (Auth::guard('admin')->check()) {
            return redirect('/panel');
        }

        return view('frontend.login.vistalogin');
    }


}

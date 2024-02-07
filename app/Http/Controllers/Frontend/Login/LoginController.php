<?php

namespace App\Http\Controllers\Frontend\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function index(){
        return view('frontend.login.vistalogin');
    }
}

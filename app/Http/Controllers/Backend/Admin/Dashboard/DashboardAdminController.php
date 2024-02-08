<?php

namespace App\Http\Controllers\Backend\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){


        return "vista admin";
    }

    public function indexRedireccionamiento()
    {
        return "si inicio sesion admin";
    }
}

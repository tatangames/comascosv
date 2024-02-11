<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function indexDashboard(){
        return view('backend.admin.dashboard.editor.vistadashboardeditor');
    }
}
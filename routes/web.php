<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;

use App\Http\Controllers\Backend\Admin\Dashboard\DashboardAdminController;
use App\Http\Controllers\Backend\Cliente\Dashboard\DashboardClienteController;
use App\Http\Controllers\Frontend\Recursos\FrontendController;



Route::get('/', [FrontendController::class,'vistaInicio'])->name('inicio');







Route::post('/admin/login', [LoginController::class, 'login']);



Route::get('/admin/dashboard', [DashboardAdminController::class,'index']);



Route::get('/panel', [DashboardAdminController::class,'indexRedireccionamiento'])->name('admin.panel');


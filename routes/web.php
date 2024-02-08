<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;

use App\Http\Controllers\Backend\Admin\Dashboard\DashboardAdminController;
use App\Http\Controllers\Backend\Cliente\Dashboard\DashboardClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);



Route::get('/admin/dashboard', [DashboardAdminController::class,'index']);



Route::get('/panel', [DashboardAdminController::class,'indexRedireccionamiento'])->name('admin.panel');


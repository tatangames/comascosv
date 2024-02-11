<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;

use App\Http\Controllers\Backend\Admin\Dashboard\DashboardAdminController;
use App\Http\Controllers\Backend\Cliente\Dashboard\DashboardClienteController;
use App\Http\Controllers\Frontend\Recursos\FrontendController;
use App\Http\Controllers\Controles\ControlRolController;
use App\Http\Controllers\Backend\Roles\RolesController;
use App\Http\Controllers\Backend\Roles\PermisoController;
use App\Http\Controllers\Backend\Dashboard\ClienteDashboardController;
use App\Http\Controllers\Backend\Dashboard\EditorDashboardController;
use App\Http\Controllers\Backend\Sistema\PerfilController;



// vista inicio
Route::get('/', [FrontendController::class,'vistaInicio'])->name('inicio');

// vista iniciar sesion
Route::get('/iniciar/sesion', [LoginController::class,'indexIniciarSesion'])->name('iniciar.sesion');


// inicio de sesion para admin, editor, cliente
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


// --- ROLES ---
Route::get('/admin/roles/index', [RolesController::class,'index'])->name('admin.roles.index');
Route::get('/admin/roles/tabla', [RolesController::class,'tablaRoles']);
Route::get('/admin/roles/lista/permisos/{id}', [RolesController::class,'vistaPermisos']);
Route::get('/admin/roles/permisos/tabla/{id}', [RolesController::class,'tablaRolesPermisos']);
Route::post('/admin/roles/permiso/borrar', [RolesController::class, 'borrarPermiso']);
Route::post('/admin/roles/permiso/agregar', [RolesController::class, 'agregarPermiso']);
Route::get('/admin/roles/permisos/lista', [RolesController::class,'listaTodosPermisos']);
Route::get('/admin/roles/permisos-todos/tabla', [RolesController::class,'tablaTodosPermisos']);
Route::post('/admin/roles/borrar-global', [RolesController::class, 'borrarRolGlobal']);

// --- PERMISOS ---
Route::get('/admin/permisos/index', [PermisoController::class,'index'])->name('admin.permisos.index');
Route::get('/admin/permisos/tabla', [PermisoController::class,'tablaUsuarios']);
Route::post('/admin/permisos/nuevo-usuario', [PermisoController::class, 'nuevoUsuario']);
Route::post('/admin/permisos/info-usuario', [PermisoController::class, 'infoUsuario']);
Route::post('/admin/permisos/editar-usuario', [PermisoController::class, 'editarUsuario']);
Route::post('/admin/permisos/nuevo-rol', [PermisoController::class, 'nuevoRol']);
Route::post('/admin/permisos/extra-nuevo', [PermisoController::class, 'nuevoPermisoExtra']);
Route::post('/admin/permisos/extra-borrar', [PermisoController::class, 'borrarPermisoGlobal']);


// --- SIN PERMISOS VISTA 403 ---
Route::get('sin-permisos', [ControlRolController::class,'indexSinPermiso'])->name('no.permisos.index');

// --- CONTROL WEB ---
Route::get('/panel', [ControlRolController::class,'indexRedireccionamiento'])->name('admin.panel');


// --- PERFIL ---
Route::get('/admin/perfil/index', [PerfilController::class,'indexEditarPerfil'])->name('admin.perfil');
Route::post('/admin/perfil/actualizar/todo', [PerfilController::class, 'editarUsuario']);


// --- DASHBOARD EDITOR ---
Route::get('/editor/dashboard/index', [EditorDashboardController::class,'indexDashboard'])->name('editor.dashboard.index');

// --- DASHBOARD CLIENTE ---
Route::get('/cliente/dashboard/index', [ClienteDashboardController::class,'indexDashboard'])->name('cliente.dashboard.index');




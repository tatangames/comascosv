<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Login\LoginController;

use App\Http\Controllers\Backend\Admin\Dashboard\DashboardAdminController;
use App\Http\Controllers\Backend\Cliente\Dashboard\DashboardClienteController;
use App\Http\Controllers\Frontend\Recursos\FrontendController;
use App\Http\Controllers\Controles\ControlRolController;
use App\Http\Controllers\Backend\Roles\RolesController;
use App\Http\Controllers\Backend\Roles\PermisoController;
use App\Http\Controllers\Backend\Dashboard\EditorDashboardController;
use App\Http\Controllers\Backend\Sistema\PerfilController;
use App\Http\Controllers\Frontend\Recursos\FrontendRecursosController;
use App\Http\Controllers\Backend\Recursos\RecursosController;
use App\Http\Controllers\Backend\Propiedad\PropiedadController;
use App\Http\Controllers\Backend\Recursos\OtrosController;



// vista inicio
Route::get('/', [FrontendController::class,'vistaInicio'])->name('inicio');

Route::get('/admin', [FrontendController::class,'vistaLogin'])->name('login.admin');



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



// ***** PANEL DE CONTROL *****

// --- PREGUNTAS FRECUENTES ---
Route::get('/admin/preguntasfre/index', [RecursosController::class,'indexPreguntasFrecuentes'])->name('admin.preguntas.frecuentes');
Route::get('/admin/preguntasfre/tabla', [RecursosController::class,'tablaPreguntasFrecuentes']);
Route::post('/admin/preguntasfre/posicion', [RecursosController::class,'preguntasFrecuentesPosicion']);
Route::post('/admin/preguntasfre/registrar', [RecursosController::class,'registrarPreguntasFrecuentes']);
Route::post('/admin/preguntasfre/informacion', [RecursosController::class,'informacionPreguntasFrecuentes']);
Route::post('/admin/preguntasfre/actualizar', [RecursosController::class,'actualizarPreguntasFrecuentes']);

// --- VENDEDORES ---
Route::get('/admin/vendedores/index', [RecursosController::class,'indexVendedores'])->name('admin.vendedores');
Route::get('/admin/vendedores/tabla', [RecursosController::class,'tablaVendedores']);
Route::post('/admin/vendedores/registrar', [RecursosController::class,'registrarVendedor']);
Route::post('/admin/vendedores/informacion', [RecursosController::class,'informacionVendedor']);
Route::post('/admin/vendedores/actualizar', [RecursosController::class,'actualizarVendedor']);

// --- LISTADO ETIQUETAS ---

Route::get('/admin/etiquetas/index', [RecursosController::class,'indexEtiquetas'])->name('admin.propiedad.etiquetas');
Route::get('/admin/etiquetas/tabla', [RecursosController::class,'tablaEtiquetas']);
Route::post('/admin/etiquetas/registrar', [RecursosController::class,'registrarEtiquetas']);
Route::post('/admin/etiquetas/informacion', [RecursosController::class,'informacionEtiquetas']);
Route::post('/admin/etiquetas/actualizar', [RecursosController::class,'actualizarEtiquetas']);


// --- LUGARES ---
Route::get('/admin/lugares/index', [RecursosController::class,'indexLugares'])->name('admin.propiedad.lugares');
Route::get('/admin/lugares/tabla', [RecursosController::class,'tablaLugares']);
Route::post('/admin/lugares/registrar', [RecursosController::class,'registrarLugares']);
Route::post('/admin/lugares/informacion', [RecursosController::class,'informacionLugares']);
Route::post('/admin/lugares/actualizar', [RecursosController::class,'actualizarLugares']);


// --- PROPIEDADES ---
Route::get('/admin/propiedad/index', [PropiedadController::class,'indexPropiedad'])->name('admin.propiedad');
Route::get('/admin/propiedad/tabla', [PropiedadController::class,'tablaPropiedad']);
Route::post('/admin/propiedad/infovendedor', [PropiedadController::class,'informacionPropiVendedor']);
Route::post('/admin/propiedad/registrar', [PropiedadController::class,'registrarPropiedad']);
Route::post('/admin/propiedad/informacion', [PropiedadController::class,'informacionPropiedad']);
Route::post('/admin/propiedad/actualizar', [PropiedadController::class,'actualizarPropiedad']);
Route::post('/admin/propiedad/vineta/actualizar', [PropiedadController::class,'actualizarPropiedadVineta']);
Route::post('/admin/propiedad/actualizardescripcion', [PropiedadController::class,'actualizarPropiedadDescripcion']);
Route::post('/admin/propiedad/informacionextra', [PropiedadController::class,'informacionPropiedadExtra']);

// --- ETIQUETA A LA PROPIEDAD ---

Route::get('/admin/propiedad/etiqueta/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadEtiqueta']);
Route::get('/admin/propiedad/etiqueta/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadEtiqueta']);
Route::post('/admin/propiedad/etiqueta/registrar', [PropiedadController::class,'registrarPropiedadEtiqueta']);
Route::post('/admin/propiedad/etiqueta/posicion', [PropiedadController::class,'actualizarPosicionPropiEtiqueta']);
Route::post('/admin/propiedad/etiqueta/borrar', [PropiedadController::class,'borrarPropiEtiqueta']);

// --- DASHBOARD EDITOR ---
Route::get('/editor/dashboard/index', [EditorDashboardController::class,'indexDashboard'])->name('editor.dashboard.index');

// --- DETALLES DE CONTACTO ---
Route::get('/admin/detallecontacto/index', [RecursosController::class,'indexDetalleContacto'])->name('admin.pagina.contactos');
Route::get('/admin/detallecontacto/tabla', [RecursosController::class,'tablaDetalleContacto']);
Route::post('/admin/detallecontacto/posicion', [RecursosController::class,'detalleContactoPosicion']);
Route::post('/admin/detallecontacto/informacion', [RecursosController::class,'informacionDetalleContacto']);
Route::post('/admin/detallecontacto/actualizar', [RecursosController::class,'actualizarDetalleContacto']);

// --- IMAGENES 4 TAG ---
Route::get('/admin/imagen4tag/index', [RecursosController::class,'indexImagen4Tag'])->name('admin.propiedad.imagen4tag');
Route::get('/admin/imagen4tag/tabla', [RecursosController::class,'tablaImagen4Tag']);
Route::post('/admin/imagen4tag/registrar', [RecursosController::class,'registrarImagen4Tag']);
Route::post('/admin/imagen4tag/informacion', [RecursosController::class,'informacionImagen4Tag']);
Route::post('/admin/imagen4tag/actualizar', [RecursosController::class,'actualizarImagen4Tag']);

// --- PROPIEDAD 4 TAG ---
Route::get('/admin/propiedad4tag/index/{idpropiedad}', [PropiedadController::class,'indexPropiedad4tag']);
Route::get('/admin/propiedad4tag/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedad4tag']);
Route::post('/admin/propiedad4tag/registrar', [PropiedadController::class,'registrarPropiedad4tag']);
Route::post('/admin/propiedad4tag/posicion', [PropiedadController::class,'actualizarPosicionPropiedad4Tag']);
Route::post('/admin/propiedad4tag/borrar', [PropiedadController::class,'borrarPropiedad4tag']);

// --- PROPIEDAD IMAGENES ---
Route::get('/admin/propiedadimagen/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadImagenes']);
Route::get('/admin/propiedadimagen/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadImagenes']);
Route::post('/admin/propiedadimagen/registrar', [PropiedadController::class,'registrarPropiedadImagenes']);
Route::post('/admin/propiedadimagen/posicion', [PropiedadController::class,'actualizarPosicionPropiedadImagenes']);
Route::post('/admin/propiedadimagen/borrar', [PropiedadController::class,'borrarPropiedadImagenes']);


// --- PRESENTACION INICIO ---

Route::get('/admin/presentacioninicio/index', [RecursosController::class,'indexPresentacionInicio'])->name('admin.presentacion.inicio');
Route::get('/admin/presentacioninicio/tabla', [RecursosController::class,'tablaPresentacionInicio']);
Route::post('/admin/presentacioninicio/informacion', [RecursosController::class,'informacionPresentacionInicio']);
Route::post('/admin/presentacioninicio/posicion', [RecursosController::class,'presentacionInicioPosicion']);
Route::post('/admin/presentacioninicio/actualizar', [RecursosController::class,'actualizarPresentacionInicio']);

// --- RECURSOS VARIOS ---

// --- QUIENES SOMOS ---
Route::get('/admin/otrosrecursos/index', [OtrosController::class,'indexOtros'])->name('admin.otros.recursos');
Route::post('/admin/otrosrecursos/actualizar', [OtrosController::class,'actualizarOtrosRecursos']);

// --- PROPIEDAD INICIO ---
Route::get('/admin/propiedadinicio/index', [PropiedadController::class,'indexPropiedadInicio'])->name('admin.propiedad.inicio');
Route::get('/admin/propiedadinicio/tabla', [PropiedadController::class,'tablaPropiedadInicio']);
Route::post('/admin/propiedadinicio/registrar', [PropiedadController::class,'registrarPropiedadInicio']);
Route::post('/admin/propiedadinicio/posicion', [PropiedadController::class,'actualizarPosicionPropiedadInicio']);
Route::post('/admin/propiedadinicio/borrar', [PropiedadController::class,'borrarPropiedadInicio']);

// --- ETIQUETAS CHECK DETALLE O LISTADO ---
Route::get('/admin/propiedaddetalle/etiqueta/index/{idpropiedad}', [PropiedadController::class,'indexEtiquetaDetalle']);
Route::get('/admin/propiedaddetalle/etiqueta/tabla/{idpropiedad}/{idtipo}', [PropiedadController::class,'tablaEtiquetaDetalle']);
Route::post('/admin/propiedaddetalle/registrar', [PropiedadController::class,'registrarPropiedadDetalle']);
Route::post('/admin/propiedaddetalle/posicion', [PropiedadController::class,'actualizarPosicionPropiedadDetalle']);
Route::post('/admin/propiedaddetalle/borrar', [PropiedadController::class,'borrarPropiedadDetalle']);

// --- PROPIEDAD PLANOS ---
Route::get('/admin/propiedadplanos/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadPlanos'])->name('admin.propiedad.planos');
Route::get('/admin/propiedadplanos/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadPlanos']);
Route::post('/admin/propiedadplanos/registrar', [PropiedadController::class,'registrarPropiedadPlanos']);
Route::post('/admin/propiedadplanos/posicion', [PropiedadController::class,'actualizarPosicionPropiedadPlanos']);
Route::post('/admin/propiedadplanos/borrar', [PropiedadController::class,'borrarPropiedadPlanos']);















// ************************** FRONTEND ***********************



// --- PREGUNTAS FRECUENTES FAQ ---
Route::get('/dudas-faq', [FrontendRecursosController::class,'vistaFaq'])->name('preguntas.frecuentes');

// --- CONTACTO ---
Route::get('/contacto', [FrontendRecursosController::class,'vistaContacto'])->name('contacto');

// --- QUIENES SOMOS ---
Route::get('/quienes-somos', [FrontendRecursosController::class,'vistaQuienesSomos'])->name('quienes.somos');

// --- PROPIEDAD REDIRECCIONAR SLUG ---
Route::get('/propiedad/{slug}', [FrontendRecursosController::class,'propiedadSlug']);





















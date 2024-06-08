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
Route::get('/', [FrontendController::class,'vistaInicio'])->name('inicio')->middleware('cookies.accepted');

Route::get('/admin', [FrontendController::class,'vistaLogin'])->name('login.admin');



// inicio de sesion para admin, editor, cliente
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


// --- VISTA PARA INGRESAR CORREO ---
Route::get('/admin/ingreso/de/correo', [LoginController::class,'indexIngresoDeCorreo']);
Route::post('/admin/enviar/correo/password', [LoginController::class, 'enviarCorreoAdministrador']);
Route::get('/admin/resetear/contrasena/administrador/{token}', [LoginController::class,'indexIngresoNuevaPasswordLink']);
Route::post('/admin/administrador/actualizacion/password', [LoginController::class, 'actualizarPasswordAdministrador']);



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

Route::post('/admin/vendedores/borrar', [RecursosController::class,'borrarVendedor']);




// --- VENDEDOR CONTACTO ---
Route::get('/admin/vendedorcontacto/index/{idpropiedad}', [RecursosController::class,'indexVendedorContacto']);
Route::get('/admin/vendedorcontacto/tabla/{idpropiedad}', [RecursosController::class,'tablaVendedorContacto']);
Route::post('/admin/vendedorcontacto/registrar', [RecursosController::class,'registrarVendedorContacto']);
Route::post('/admin/vendedorcontacto/posicion', [RecursosController::class,'actualizarPosicionVendedorContacto']);
Route::post('/admin/vendedorcontacto/borrar', [RecursosController::class,'borrarVendedorContacto']);





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
Route::get('/admin/propiedadplanos/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadPlanos']);
Route::get('/admin/propiedadplanos/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadPlanos']);
Route::post('/admin/propiedadplanos/registrar', [PropiedadController::class,'registrarPropiedadPlanos']);
Route::post('/admin/propiedadplanos/posicion', [PropiedadController::class,'actualizarPosicionPropiedadPlanos']);
Route::post('/admin/propiedadplanos/borrar', [PropiedadController::class,'borrarPropiedadPlanos']);

// --- PROPIEDAD IMAGEN 360 ---
Route::get('/admin/propiedadimagen360/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadImagen360']);
Route::get('/admin/propiedadimagen360/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadImagen360']);
Route::post('/admin/propiedadimagen360/registrar', [PropiedadController::class,'registrarPropiedadImagen360']);
Route::post('/admin/propiedadimagen360/posicion', [PropiedadController::class,'actualizarPosicionPropiedadImagen360']);
Route::post('/admin/propiedadimagen360/borrar', [PropiedadController::class,'borrarPropiedadImagen360']);

// --- PROPIEDAD ETIQUETA POPULAR ---
Route::get('/admin/propiedadtagpopular/index/{idpropiedad}', [PropiedadController::class,'indexTagPopular']);
Route::get('/admin/propiedadtagpopular/tabla/{idpropiedad}', [PropiedadController::class,'tablaTagPopular']);
Route::post('/admin/propiedadtagpopular/registrar', [PropiedadController::class,'registrarTagPopular']);
Route::post('/admin/propiedadtagpopular/borrar', [PropiedadController::class,'borrarTagPopular']);

// --- LUGARES INICIO ---
Route::get('/admin/lugaresinicio/index', [RecursosController::class,'indexLugaresInicio'])->name('admin.lugares.inicio');
Route::get('/admin/lugaresinicio/tabla', [RecursosController::class,'tablaLugaresInicio']);
Route::post('/admin/lugaresinicio/registrar', [RecursosController::class,'registrarLugaresInicio']);
Route::post('/admin/lugaresinicio/posicion', [RecursosController::class,'actualizarPosicionLugaresInicio']);
Route::post('/admin/lugaresinicio/borrar', [RecursosController::class,'borrarLugaresInicio']);

// --- PIE DE PAGINA ---
Route::get('/admin/piepagina/index', [RecursosController::class,'indexPiePagina'])->name('admin.pie.de.pagina');
Route::post('/admin/piepagina/actualizar', [RecursosController::class,'actualizarColumnas']);

Route::get('/admin/piepagina/columna/index/{idfila}', [RecursosController::class,'indexPieColumnasFila']);
Route::get('/admin/piepagina/columna/tabla/{idfila}', [RecursosController::class,'tablaPieColumnasFila']);
Route::post('/admin/piepagina/columna/posicion', [RecursosController::class,'actualizarPosicionColumnaFila']);
Route::post('/admin/piepagina/columna/borrar', [RecursosController::class,'borrarColumnaFila']);
Route::post('/admin/piepagina/columna/registrar', [RecursosController::class,'registrarFilaColumna']);
Route::post('/admin/piepagina/columna/informacion', [RecursosController::class,'informacionFilaColumna']);
Route::post('/admin/piepagina/columna/actualizar', [RecursosController::class,'actualizarFilaColumna']);

// --- ETIQUETAS POPULARES ---
Route::get('/admin/tagpopular/index', [RecursosController::class,'indexTagPopular'])->name('admin.tag.popular');
Route::get('/admin/tagpopular/tabla', [RecursosController::class,'tablaTagPopular']);
Route::post('/admin/tagpopular/registrar', [RecursosController::class,'registrarTagPopular']);
Route::post('/admin/tagpopular/informacion', [RecursosController::class,'informacionTagPopular']);
Route::post('/admin/tagpopular/actualizar', [RecursosController::class,'actualizarTagPopular']);


// --- PROPIEDAD VIDEOS ---
Route::get('/admin/porpiedadvideo/index/{idpropiedad}', [PropiedadController::class,'indexPropiedadVideo']);
Route::get('/admin/porpiedadvideo/tabla/{idpropiedad}', [PropiedadController::class,'tablaPropiedadVideo']);
Route::post('/admin/porpiedadvideo/registrar', [PropiedadController::class,'registrarPropiedadVideo']);
Route::post('/admin/porpiedadvideo/informacion', [PropiedadController::class,'infoPropiedadVideo']);
Route::post('/admin/porpiedadvideo/posicion', [PropiedadController::class,'posicionPropiedadVideo']);
Route::post('/admin/porpiedadvideo/actualizar', [PropiedadController::class,'actualizarPropiedadVideo']);
Route::post('/admin/porpiedadvideo/borrar', [PropiedadController::class,'borrarPropiedadVideo']);


// --- ELIMINACION TOTAL DE PROPIEDAD ---
Route::post('/admin/propiedad/eliminacion', [PropiedadController::class,'eliminacionPropiedad']);


// --- REDES SOCIALES FOOTER ---

Route::get('/admin/redessociales/index', [OtrosController::class,'indexRedesFooter'])->name('admin.redes.footer');
Route::post('/admin/redessociales/actualizar', [OtrosController::class,'actualizarRedesFooter']);


// DATOS PARA RESPONSABILIDAD
Route::get('/admin/responsabilidad/index', [OtrosController::class,'indexResponsabilidad'])->name('admin.responsabilidad');
Route::post('/admin/responsabilidad/actualizar', [OtrosController::class,'actualizarResponsabilidad']);

// DATOS PARA VISION, MISION, ETC


Route::get('/admin/visionmision/index', [RecursosController::class,'indexVision'])->name('admin.vision.inicio');
Route::get('/admin/visionmision/tabla', [RecursosController::class,'tablaVision']);
Route::post('/admin/visionmision/informacion', [RecursosController::class,'informacionVision']);
Route::post('/admin/visionmision/posicion', [RecursosController::class,'presentacionVisionPosicion']);
Route::post('/admin/visionmision/actualizar', [RecursosController::class,'actualizarVisionInicio']);


// --- SOLICITUDES ---

Route::get('/admin/solicitudes/index', [RecursosController::class,'indexSolicitudes'])->name('admin.solicitudes');
Route::get('/admin/solicitudes/tabla', [RecursosController::class,'tablaSolicitudes']);
Route::post('/admin/solicitudes/registrar', [RecursosController::class,'registrarSolicitudes']);
Route::post('/admin/solicitudes/informacion', [RecursosController::class,'infoSolicitudes']);
Route::post('/admin/solicitudes/posicion', [RecursosController::class,'posicionSolicitudes']);
Route::post('/admin/solicitudes/actualizar', [RecursosController::class,'actualizarSolicitudes']);
Route::post('/admin/solicitudes/borrar', [RecursosController::class,'borrarSolicitudes']);




// ************************** FRONTEND ***********************



// --- PREGUNTAS FRECUENTES FAQ ---
Route::get('/dudas-faq', [FrontendRecursosController::class,'vistaFaq'])->name('preguntas.frecuentes');

// --- CONTACTO ---
Route::get('/contacto', [FrontendRecursosController::class,'vistaContacto'])->name('contacto');

// --- QUIENES SOMOS ---
Route::get('/quienes-somos', [FrontendRecursosController::class,'vistaQuienesSomos'])->name('quienes.somos');

// --- PROPIEDAD REDIRECCIONAR SLUG ---
Route::get('/propiedad/{slug}', [FrontendRecursosController::class,'propiedadSlug']);

// --- BUSQUEDA PROPIEDAD ---
Route::get('/busqueda', [FrontendRecursosController::class,'paginaBusqueda'])->name('propiedad.buscada');

// --- MAPA DE PROPIEDADES ---
Route::get('/mapa', [FrontendRecursosController::class,'mapaPropiedades'])->name('propiedad.mapa');

// --- AVISO DE COOKIES
Route::get('/aviso/cookies', [FrontendRecursosController::class,'indexAvisoCookies'])->name('aviso.cookies');

// --- POLITICA DE PRIVACIDAD ---
Route::get('/politica-privacidad', [FrontendRecursosController::class,'indexPoliticaPrivacidad'])->name('politica.privacidad');












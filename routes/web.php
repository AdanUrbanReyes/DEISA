<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/accesos', 'AccesosController@index')->name('accesos');
Route::get('/accesos/buscar/puestos/{departamento}', 'AccesosController@obtenPuestos');
Route::get('/accesos/buscar/menusConAcceso/{departamento}/{puesto}', 'AccesosController@obtenerMenusConAcceso');
Route::get('/accesos/buscar/menusSinAcceso/{departamento}/{puesto}', 'AccesosController@obtenerMenusSinAcceso');
Route::post('/accesos/agregar', 'AccesosController@agregar');
Route::delete('/accesos/quitar', 'AccesosController@quitar');

Route::get('/aceptaciones', 'AceptacionesController@index')->name('aceptaciones');

Route::get('/almacen', 'AlmacenController@index')->name('almacen');

Route::get('/areas', 'AreasController@index')->name('areas');
Route::get('/areas/autocompletado/nombre/{nombre}', 'AreasController@obtenAutocompletadoNombreArea');
Route::get('/areas/buscar/{nombre}', 'AreasController@buscar');
Route::post('/areas', 'AreasController@crear');
Route::match(['put', 'patch'], '/areas/{nombre}', 'AreasController@actualizar');


Route::get('/asignacionAnalisis', 'AsignacionAnalisisController@index')->name('asignacionAnalisis');

Route::get('/bitacora', 'BitacoraController@index')->name('bitacora');

Route::get('/bitacoraRecepcionLaboratorio', 'BitacoraRecepcionLaboratorioController@index')->name('bitacoraRecepcionLaboratorio');

Route::get('/cadenaCustodia', 'CadenaCustodiaController@index')->name('cadenaCustodia');

Route::get('/capturaResultados', 'CapturaResultadosController@index')->name('capturaResultados');

Route::get('/clientes', 'ClientesController@index')->name('clientes');
Route::get('/clientes/buscar/{numero}', 'ClientesController@buscar');
Route::post('/clientes', 'ClientesController@crear');
Route::match(['put', 'patch'], '/clientes/{numero}', 'ClientesController@actualizar');
Route::delete('/clientes/eliminar/{numero}', 'ClientesController@eliminar');

Route::get('/codigosPostales', 'CodigosPostalesController@index')->name('codigosPostales');
Route::get('/codigosPostales/obtener/{codigoPostal}', 'CodigosPostalesController@obtenCodigoPostal');
Route::get('/codigosPostales/obtener/{codigoPostal}/{estado}/{municipio}', 'CodigosPostalesController@obtenAsentamientos');

Route::get('/consumibles', 'ConsumiblesController@index')->name('consumibles');

Route::get('/correosElectronicos', 'CorreosElectronicosController@index')->name('correosElectronicos');

Route::get('/cotizaciones', 'CotizacionesAguasResidualesController@index')->name('cotizaciones');

Route::get('/entregaResultadosLaboratorio', 'EntregaResultadosLaboratorioController@index')->name('entregaResultadosLaboratorio');

Route::get('/equipo', 'EquipoController@index')->name('equipo');

Route::get('/facturacion', 'FacturacionController@index')->name('facturacion');

Route::get('/formatosReporteAnalisisMuestras', 'FormatosReporteAnalisisMuestrasController@index')->name('formatosReporteAnalisisMuestras');

Route::get('/ingresoMuestras', 'IngresoMuestrasController@index')->name('ingresoMuestras');

Route::get('/metodologias', 'MetodologiasController@index')->name('metodologias');

Route::get('/monitoreo', 'MonitoreoController@index')->name('monitoreo');

Route::get('/ordenesCompra', 'OrdenesCompraController@index')->name('ordenesCompra');

Route::get('/ordenesCompraCotizaciones', 'OrdenesCompraCotizacionesController@index')->name('ordenesCompraCotizaciones');

Route::get('/ordenesTrabajo', 'OrdenesTrabajoController@index')->name('ordenesTrabajo');

Route::get('/paquetes', 'PaquetesController@index')->name('paquetes');

Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::match(['put', 'patch'], '/perfil/{email}', 'PerfilController@update');

Route::get('/proveedores', 'ProveedoresController@index')->name('proveedores');

Route::get('/recepcionMuestrasArea', 'RecepcionMuestrasAreaController@index')->name('recepcionMuestrasArea');

Route::get('/recepcionMuestrasLaboratorio', 'RecepcionMuestrasLaboratorioController@index')->name('recepcionMuestrasLaboratorio');

Route::get('/resultadosLaboratorio', 'ResultadosLaboratorioController@index')->name('resultadosLaboratorio');

Route::get('/seguimiento', 'SeguimientoController@index')->name('seguimiento');

Route::get('/superUsuario', 'SuperUsuarioController@index')->name('superUsuario');

Route::get('/supervisionResultadosLaboratorio', 'SupervisionResultadosLaboratorioController@index')->name('supervisionResultadosLaboratorio');
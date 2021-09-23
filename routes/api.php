<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AplicacionController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CuerpoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\ListaDinamicaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilUsuarioController;
use App\Http\Controllers\RequerimientoController;
use App\Http\Controllers\RutaCarreraController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioMenuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Login
Route::post('login', [UsuarioController::class, 'login']);

// Listas Dinamicas
Route::get('/listadinamica/getListasDinamicasFull',[ListaDinamicaController::class, 'getListasDinamicasFull']);

// Autenticar los controladores
Route::group(['middleware' => ['jwt.verify']], function() {
    // Aplicaciones
    Route::get('/aplicacion/getAplicacionesFull', [AplicacionController::class, 'getAplicacionesFull']);
    Route::post('/aplicacion/getAplicaciones', [AplicacionController::class, 'getAplicaciones']);
    Route::post('/aplicacion/crearAplicaciones', [AplicacionController::class, 'crearAplicaciones']);
    Route::post('/aplicacion/actualizarAplicaciones', [AplicacionController::class, 'actualizarAplicaciones']);

    // Cargos
    Route::post('/cargo/getCargos', [CargoController::class, 'getCargos']);
    Route::post('/cargo/crearCargos', [CargoController::class, 'crearCargos']);
    Route::post('/cargo/actualizarCargos', [CargoController::class, 'actualizarCargos']);
    Route::get('/cargo/getCargosFull', [CargoController::class, 'getCargosFull']);

    // Rutas y Requisitos (Cargo)
    Route::post('/cargo/getRutasRequisitos',[CargoController::class, 'getRutasRequisitos']);
    Route::post('/cargo/crearRutasRequisitos',[CargoController::class, 'crearRutasRequisitos']);
    Route::post('/cargo/actualizarRutasRequisitos',[CargoController::class, 'actualizarRutasRequisitos']);

    // Areas
    Route::post('/area/getAreas',[AreaController::class, 'getAreas']);
    Route::post('/area/crearAreas',[AreaController::class, 'crearAreas']);
    Route::post('/area/actualizarAreas',[AreaController::class, 'actualizarAreas']);

    // Cuerpos
    Route::get('/cuerpo/getCuerposFull',[CuerpoController::class, 'getCuerposFull']);
    Route::post('/cuerpo/getCuerpos',[CuerpoController::class, 'getCuerpos']);
    Route::post('/cuerpo/crearCuerpos',[CuerpoController::class, 'crearCuerpos']);
    Route::post('/cuerpo/actualizarCuerpos',[CuerpoController::class, 'actualizarCuerpos']);

    // Especialidades
    Route::get('/especialidad/getEspecialidadesFull', [EspecialidadController::class, 'getEspecialidadesFull']);
    Route::post('/especialidad/getEspecialidades',[EspecialidadController::class, 'getEspecialidades']);
    Route::post('/especialidad/crearEspecialidades',[EspecialidadController::class, 'crearEspecialidades']);
    Route::post('/especialidad/actualizarEspecialidades',[EspecialidadController::class, 'actualizarEspecialidades']);

    // Educaciones y Conocimientos (Cargo)
    Route::post('/cargo/getEducaciones',[CargoController::class, 'getEducaciones']);
    Route::post('/cargo/crearEducaciones',[CargoController::class, 'crearEducaciones']);
    Route::post('/cargo/actualizarEducaciones',[CargoController::class, 'actualizarEducaciones']);

    // Grados
    Route::post('/grado/getGrados', [GradoController::class, 'getGrados']);
    Route::post('/grado/crearGrados', [GradoController::class, 'crearGrados']);
    Route::post('/grado/actualizarGrados', [GradoController::class, 'actualizarGrados']);

    // Listas Dinamicas
    Route::post('/listadinamica/getNombresListas',[ListaDinamicaController::class, 'getNombresListas']);
    Route::post('/listadinamica/crearNombresListas',[ListaDinamicaController::class, 'crearNombresListas']);
    Route::post('/listadinamica/actualizarNombresListas',[ListaDinamicaController::class, 'actualizarNombresListas']);
    Route::post('/listadinamica/getListasDinamicas',[ListaDinamicaController::class, 'getListasDinamicas']);
    Route::post('/listadinamica/crearListasDinamicas',[ListaDinamicaController::class, 'crearListasDinamicas']);
    Route::post('/listadinamica/actualizarListasDinamicas',[ListaDinamicaController::class, 'actualizarListasDinamicas']);
    Route::get('/listadinamica/getNombresListasFull',[ListaDinamicaController::class, 'getNombresListasFull']);

    // Menu
    Route::post('/menu/getMenus', [MenuController::class, 'getMenus']);
    Route::post('/menu/crearMenus', [MenuController::class, 'crearMenus']);
    Route::post('/menu/actualizarMenus', [MenuController::class, 'actualizarMenus']);

    // Perfiles
    Route::post('/perfil/getPerfiles', [PerfilController::class, 'getPerfiles']);
    Route::post('/perfil/crearPerfiles', [PerfilController::class, 'crearPerfiles']);
    Route::post('/perfil/actualizarPerfiles', [PerfilController::class, 'actualizarPerfiles']);
    Route::get('/perfil/getPerfilesFull', [PerfilController::class, 'getPerfilesFull']);

    // Perfiles-Usuarios
    Route::post('/perfilusuario/getPerfilesUsuarios', [PerfilUsuarioController::class, 'getPerfilesUsuarios']);
    Route::post('/perfilusuario/crearPerfilesUsuario', [PerfilUsuarioController::class, 'crearPerfilesUsuarios']);
    Route::post('/perfilusuario/actualizarPerfilesUsuarios', [PerfilUsuarioController::class, 'actualizarPerfilesUsuarios']);

    // Requerimientos
    Route::post('/requerimiento/getRequerimientos',[RequerimientoController::class, 'getRequerimientos']);
    Route::post('/requerimiento/crearRequerimientos',[RequerimientoController::class, 'crearRequerimientos']);
    Route::post('/requerimiento/actualizarRequerimientos',[RequerimientoController::class, 'actualizarRequerimientos']);

    // Ruta de Carrera
    Route::post('/rutacarrera/getRutaCarrera', [RutaCarreraController::class, 'getRutaCarrera']);
    Route::post('/rutacarrera/crearRutaCarrera', [RutaCarreraController::class, 'crearRutaCarrera']);
    Route::post('/rutacarrera/actualizarRutaCarrera', [RutaCarreraController::class, 'actualizarRutaCarrera']);

    // Usuarios
    Route::get('/usuario/getUsuariosFull', [UsuarioController::class, 'getUsuariosFull']);
    Route::post('/usuario/getUsuarios', [UsuarioController::class, 'getUsuarios']);
    Route::post('/usuario/crearUsuarios', [UsuarioController::class, 'crearUsuarios']);
    Route::post('/usuario/actualizarUsuarios', [UsuarioController::class, 'actualizarUsuarios']);

    // Usuarios-Menu
    Route::post('/usuariomenu/crearUsuarioMenu', [UsuarioController::class, 'crearUsuarioMenu']);
    Route::post('/usuariomenu/actualizarUsuarioMenu', [UsuarioController::class, 'actualizarUsuarioMenu']);
});
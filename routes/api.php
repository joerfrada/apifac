<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CargoController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\ListaDinamicaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilUsuarioController;
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
    // Cargos
    Route::post('/cargo/getCargos', [CargoController::class, 'getCargos']);
    Route::post('/cargo/crearCargos', [CargoController::class, 'crearCargos']);
    Route::post('/cargo/actualizarCargos', [CargoController::class, 'actualizarCargos']);

    // Rutas y Requisitos (Cargo)
    Route::post('/cargo/getRutasRequisitos',[CargoController::class, 'getRutasRequisitos']);
    Route::post('/cargo/crearRutasRequisitos',[CargoController::class, 'crearRutasRequisitos']);
    Route::post('/cargo/actualizarRutasRequisitos',[CargoController::class, 'actualizarRutasRequisitos']);

    // Areas (Cargo)
    Route::post('/cargo/getAreas',[CargoController::class, 'getAreas']);
    Route::post('/cargo/crearAreas',[CargoController::class, 'crearAreas']);
    Route::post('/cargo/actualizarAreas',[CargoController::class, 'actualizarAreas']);

    // Cuerpos (Cargo)
    Route::post('/cargo/getCuerpos',[CargoController::class, 'getCuerpos']);
    Route::post('/cargo/crearCuerpos',[CargoController::class, 'crearCuerpos']);
    Route::post('/cargo/actualizarCuerpos',[CargoController::class, 'actualizarCuerpos']);

    // Especialidades (Cargo)
    Route::post('/cargo/getEspecialidades',[CargoController::class, 'getEspecialidades']);
    Route::post('/cargo/crearEspecialidades',[CargoController::class, 'crearEspecialidades']);
    Route::post('/cargo/actualizarEspecialidades',[CargoController::class, 'actualizarEspecialidades']);

    // Educaciones y Conocimientos (Cargo)
    Route::post('/cargo/getEducaciones',[CargoController::class, 'getEducaciones']);
    Route::post('/cargo/crearEducaciones',[CargoController::class, 'crearEducaciones']);
    Route::post('/cargo/actualizarEducaciones',[CargoController::class, 'actualizarEducaciones']);

    // Especialidades
    Route::get('/especialidad/getEspecialidadesFull', [EspecialidadController::class, 'getEspecialidadesFull']);

    // Grados
    Route::post('/grado/getGrados', [GradoController::class, 'getCargos']);
    Route::post('/grado/crearGrados', [GradoController::class, 'crearCargos']);
    Route::post('/grado/actualizarGrados', [GradoController::class, 'actualizarCargos']);

    // Listas Dinamicas
    Route::get('/listadinamica/getNombresListasFull',[ListaDinamicaController::class, 'getNombresListasFull']);
    Route::post('/listadinamica/getNombresListas',[ListaDinamicaController::class, 'getNombresListas']);
    Route::post('/listadinamica/crearNombresListas',[ListaDinamicaController::class, 'crearNombresListas']);
    Route::post('/listadinamica/actualizarNombresListas',[ListaDinamicaController::class, 'actualizarNombresListas']);
    Route::post('/listadinamica/getListasDinamicas',[ListaDinamicaController::class, 'getListasDinamicas']);
    Route::post('/listadinamica/crearListasDinamicas',[ListaDinamicaController::class, 'crearListasDinamicas']);
    Route::post('/listadinamica/actualizarListasDinamicas',[ListaDinamicaController::class, 'actualizarListasDinamicas']);

    // Menu
    Route::post('/menu/getMenus', [MenuController::class, 'getMenus']);
    Route::post('/menu/crearMenus', [MenuController::class, 'crearMenus']);
    Route::post('/menu/actualizarMenus', [MenuController::class, 'actualizarMenus']);

    // Perfiles
    Route::post('/perfil/getPerfiles', [PerfilController::class, 'getPerfiles']);
    Route::post('/perfil/crearPerfiles', [PerfilController::class, 'crearPerfiles']);
    Route::post('/perfil/actualizarPerfiles', [PerfilController::class, 'actualizarPerfiles']);

    // Perfiles-Usuarios
    Route::post('/perfilusuario/getPerfilesUsuarios', [PerfilUsuarioController::class, 'getPerfilesUsuarios']);
    Route::post('/perfilusuario/crearPerfilesUsuario', [PerfilUsuarioController::class, 'crearPerfilesUsuarios']);
    Route::post('/perfilusuario/actualizarPerfilesUsuarios', [PerfilUsuarioController::class, 'actualizarPerfilesUsuarios']);

    // Ruta de Carrera
    Route::post('/rutacarrera/getRutaCarerra', [RutaCerraController::class, 'getRutaCarrera']);
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
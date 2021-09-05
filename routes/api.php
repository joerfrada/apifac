<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DemoController;

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

// Autenticar los controladores
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/menu/getMenus', [MenuController::class, 'getMenus']);
});

// Route::get('/demo/getDemos', [DemoController::class, 'getDemos']);
// Route::post('/demo/crearDemos', [DemoController::class, 'crearDemos']);
// Route::post('/demo/actualizarDemos', [DemoController::class, 'actualizarDemos']);
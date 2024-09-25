<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContratoUsuarioController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('contratos', [ContratoController::class, 'index']);
Route::get('contratos/{id}', [ContratoController::class, 'show']);
Route::post('agregarcontrato', [ContratoController::class, 'store']);
Route::put('updatecontrato/{id}', [ContratoController::class, 'update']);
Route::delete('deletecontrato/{id}', [ContratoController::class, 'destroy']);

// Rutas para tareas
Route::get('tareas', [TareaController::class, 'index']);
Route::get('tareas/{id}', [TareaController::class, 'show']);
Route::post('tareas', [TareaController::class, 'store']);
Route::put('tareas/{id}', [TareaController::class, 'update']);
Route::delete('tareas/{id}', [TareaController::class, 'destroy']);

// Rutas para usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('agregar/usuarios', [UsuarioController::class, 'store']);
Route::put('actualizar/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('eliminar/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::post('login', [UsuarioController::class, 'login']);

// Rutas para gestionar la relación de usuarios y contratos
Route::post('contratos/{id_contrato}/usuarios', [ContratoUsuarioController::class, 'attachUsersToContrato']);
Route::delete('contratos/{id_contrato}/usuarios', [ContratoUsuarioController::class, 'detachUsersFromContrato']);
Route::get('contratos/{id_contrato}/usuarios', [ContratoUsuarioController::class, 'getUsersByContrato']);
Route::get('contratos/{id_contrato}', [ContratoUsuarioController::class, 'getContratosByUsuario']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ImageController;
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
Route::post('/cambiar-password', [UsuarioController::class, 'cambiarPassword']);

Route::get('/sync-empleados', [EmpleadoController::class, 'syncEmpleados']);
Route::post('/login-empleado', [EmpleadoController::class, 'login']);
Route::post('/upload-image', [ImageController::class, 'store'])->name('upload.image');
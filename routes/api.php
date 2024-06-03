<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MedicamentoDepartamentoController;
use App\Http\Controllers\UserController;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
# Todas las rutas deben estar protegidas para que no se puedan acceder sin autenticarnos.
#La unica ruta que estara si nautenticacion sera la ruta de registro ya que es ahi donde el usuario obtiene el token

Route::post('auth/register', [UserController::class, 'store']);
Route::post('auth/login', [UserController::class, 'login']);

//Grupo de rutas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('medicos', MedicoController::class);
});

Route::controller(MedicamentoController::class)->group(function () {
    Route::get('/medicamentos', 'index');
    Route::post('/medicamento', 'store');
    Route::get('/medicamento/{id}', 'show');
    Route::put('/medicamento/{id}', 'update');
    Route::delete('/medicamento/{id}', 'destroy');
});

Route::controller(MedicamentoDepartamentoController::class)->group(
    function () {
        Route::get('/medicamentosD', 'index');
        Route::post('/medicamentoD', 'store');
        Route::get('/medicamentoD/{id}', 'show');
        Route::put('/medicamentoD/{id}', 'update');
        Route::delete('/medicamentoD/{id}', 'destroy');
    }
);

Route::controller(DepartamentoController::class)->group(
    function () {
        Route::get('/departamentos/{id}', 'index');
        Route::post('/departamento', 'store');
        Route::get('/departamento/{id}', 'show');
        Route::put('/departamento/{id}', 'update');
        Route::delete('/departamento/{id}', 'destroy');
    }

);

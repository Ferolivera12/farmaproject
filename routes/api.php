<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MedicamentoDepartamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MedicamentoPedidoController;
use App\Http\Controllers\UserController;
use App\Models\Medico;
use App\Models\Proveedor;
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
Route::get('usuarios', [UserController::class, 'index']);
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
        Route::get('/departamentos', 'index');
        Route::post('/departamento', 'store');
        Route::get('/departamento/{id}', 'show');
        Route::put('/departamento/{id}', 'update');
        Route::delete('/departamento/{id}', 'destroy');
    }
);
Route::controller(CategoriaController::class)->group(
    function () {
        Route::get('/categorias', 'index');
        Route::post('/categoria', 'store');
        Route::get('/categoria/{id}', 'show');
        Route::put('/categoria/{id}', 'update');
        Route::delete('/categoria/{id}', 'destroy');
    }
);

Route::controller(ProveedorController::class)->group(
    function () {
        Route::get('/proveedores', 'index');
        Route::post('/proveedor', 'store');
        Route::get('/proveedor/{id}', 'show');
        Route::put('/proveedor/{id}', 'update');
        Route::delete('/proveedor/{id}', 'destroy');
    }
);

Route::controller(PedidoController::class)->group(
    function () {
        Route::get('/pedidos', 'index');
        Route::post('/pedido', 'store');
        Route::get('/pedido/{id}', 'show');
        Route::put('/pedido/{id}', 'update');
        Route::delete('/pedido/{id}', 'destroy');
    }
);

Route::controller(MedicamentoPedidoController::class)->group(
    function () {
        Route::get('/medicamentopedidos', 'index');
        Route::post('/', 'store');
        Route::get('/medicamentopedido/{id}', 'show');
        Route::put('/medicamentopedido/{id}', 'update');
        Route::delete('/medicamentopedido/{id}', 'destroy');
    }
);

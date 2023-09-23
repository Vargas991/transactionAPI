<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransaccionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/cuentas', [CuentaController::class, 'index']);


Route::get('/transacciones', [TransaccionController::class, 'index']);
Route::post('/deposito', [TransaccionController::class, 'deposito']);

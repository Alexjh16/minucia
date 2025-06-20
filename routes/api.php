<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BloqueController;
use App\Http\Controllers\Api\PiezaController;


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


route::get('bloques', BloqueController::class);
route::get('piezas', PiezaController::class);
//get pieza por id pieza
route::get('piezas/{id}', [PiezaController::class, 'show']);


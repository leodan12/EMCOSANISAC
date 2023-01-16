<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\UserController;
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
//Route::apiResource('v1/books', BookV1::class)
    //  ->only(['index','show', 'destroy'])
    //  ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);

Route::post('/register', [LoginController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    
    //Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);
    
});

//rutas para las ventas 
Route::get('/listaventascliente/{token}', [VentaController::class, 'listaventas']);
Route::get('/datosuser', [UserController::class, 'datosuser']);//->middleware('auth:sanctum');



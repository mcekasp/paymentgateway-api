<?php

use App\Http\Controllers\API\LoggingController;
use App\Http\Controllers\API\MetodePembayaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PesananController;
use App\Http\Controllers\API\PendapatanController;

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

Route::get('metode_pembayaran', [MetodePembayaranController::class, 'index']);
Route::post('metode_pembayaran/store', [MetodePembayaranController::class, 'store']);
Route::get('metode_pembayaran/show/{id}', [MetodePembayaranController::class, 'show']);
Route::post('metode_pembayaran/update/{id}', [MetodePembayaranController::class, 'update']);
Route::get('metode_pembayaran/destroy/{id}', [MetodePembayaranController::class, 'destroy']);

<<<<<<< HEAD
Route::get('logging', [LoggingController::class, 'index']);
Route::post('logging/store', [LoggingController::class, 'store']);
Route::get('logging/show/{id_logging}', [LoggingController::class, 'show']);
Route::post('logging/update/{id_logging}', [LoggingController::class, 'update']);
=======
Route::get('pesanan', [PesananController::class, 'index']);
Route::post('pesanan/store', [PesananController::class, 'store']);
Route::get('pesanan/show/{id}', [PesananController::class, 'show']);

Route::get('pendapatan', [PendapatanController::class, 'index']);
Route::post('pendapatan/store', [PendapatanController::class, 'store']);
>>>>>>> origin/Gina

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

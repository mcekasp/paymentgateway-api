<?php

use App\Http\Controllers\API\MetodePembayaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

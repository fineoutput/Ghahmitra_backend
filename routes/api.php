<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


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

    Route::get('/states', [AuthController::class, 'getstates']);
    Route::post('/cities', [AuthController::class, 'getcityes']);
    Route::post('/register-partner', [AuthController::class, 'register_partner']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});

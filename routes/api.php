<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controller
use App\Http\Controllers\Api\Auth\LoginController;
Use App\Http\Controllers\Api\BusinessController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/token', [LoginController::class, 'login']);

Route::group(['prefix' => 'business', 'middleware' => 'auth:sanctum'], function(){
    Route::post('', [BusinessController::class, 'store']);
    Route::put('/{id}', [BusinessController::class, 'update']);
    Route::delete('/{id}', [BusinessController::class, 'destroy']);
});
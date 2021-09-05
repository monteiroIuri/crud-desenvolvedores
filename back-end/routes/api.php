<?php
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

Route::group(['prefix' => 'developers'], function() {
    Route::get('/', [\App\Http\Controllers\DeveloperController::class, 'index']);
    Route::post('/store', [\App\Http\Controllers\DeveloperController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\DeveloperController::class, 'show']);
    Route::put('/{id}', [\App\Http\Controllers\DeveloperController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\DeveloperController::class, 'destroy']);
});

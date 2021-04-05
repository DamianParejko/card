<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CardController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/card')-> group(function() {
    Route::get('/', [CardController::class, 'index']);
    Route::post('/', [CardController::class, 'store']);
    Route::get('/edit/{card}', [CardController::class, 'edit']);
    Route::patch('/{card}', [CardController::class, 'update']);
    Route::delete('/{card}', [CardController::class, 'destroy']);
});
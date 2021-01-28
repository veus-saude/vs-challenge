<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProdutoController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {
    Route::post('auth/login', [AuthController::class, 'login'])
        ->name('api/login');

    Route::group(['middleware' => ['apiJwt']], function () {

        Route::post('auth/logout', [AuthController::class, 'logout'])
            ->name('api/logout');

        Route::get('produtos', [ProdutoController::class, 'index']);
    });
});




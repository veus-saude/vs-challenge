<?php

use Illuminate\Http\Request;

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

Route::prefix("auth")->group(function(){
    Route::post("registro", "AutenticadorController@registro");
    Route::post("login", "AutenticadorController@login");
    
    Route::middleware("auth:api")->group(function() {
        Route::post("logout", "AutenticadorController@logout");
    });
});
Route::prefix("v1")->group(function(){
    Route::get("products", "ProdutosController@view")->middleware("auth:api");
});

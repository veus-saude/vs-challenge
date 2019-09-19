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

//Rotas de produtos
Route::group(['prefix' => 'v1'],function(){

    Route::namespace('Api')->group(function(){

        //Produtos
        Route::resource('/produtos', 'ProdutoController')->middleware('auth.basic');

    });

});

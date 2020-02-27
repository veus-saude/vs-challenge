<?php

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

Route::group(['middleware' => 'apiJwt', 'prefix' => 'v1'], function () {


    /* ROTAS "/api/v1/products/" */

    Route::group(['prefix' => 'products'], function () {
        /*
         * Isto será acessível via http://localhost:[porta]/api/v1/products/
         */
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@show');
        Route::post('/', 'ProductController@store');
        Route::put('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@destroy');

    });

    Route::post('auth/logout', 'Api\\AuthController@logout');

});
//ROTA para recuperação do token
Route::post('auth/login', 'Api\\AuthController@login');


//teste de versão de rota
Route::group(['prefix' => 'v2'], function () {
    Route::get('teste', function () {
        return "teste";
    });
});

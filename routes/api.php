<?php

use Illuminate\Http\Request;

Route::post('auth', 'Api\AuthController@authenticate');

Route::group([
    'namespace'=> 'Api',
    'middleware' => 'jwt.auth'
], function () {
    Route::get('auth', 'AuthController@getAuthenticatedUser');
    Route::apiResource('produtos','ProdutoController');
    Route::apiResource('marcas','MarcaController');
});    
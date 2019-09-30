<?php

use Illuminate\Http\Request;

Route::get('health', function (Request $request) {
    return response()->json([
        'status' => 'OK'
    ]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
});

Route::group([
    'prefix' => 'products',
    'middleware' => 'jwt.auth'
], function () {
    Route::get('', 'ProductsController@index');
    Route::get('{product}', 'ProductsController@show');

    Route::group(['middleware' => 'can:is-admin'], function () {
        Route::post('', 'ProductsController@store');
        Route::put('{product}', 'ProductsController@update');
        Route::delete('{product}', 'ProductsController@destroy');
    });
});


<?php

use Illuminate\Http\Request;

Route::get('health', function (Request $request) {
    return response()->json([
        'status' => 'OK'
    ]);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'products'
], function () {
    Route::get('', 'ProductsController@index');
    Route::post('', 'ProductsController@store');
    Route::get('{product}', 'ProductsController@show');
    Route::put('{product}', 'ProductsController@update');
    Route::delete('{product}', 'ProductsController@destroy');
});


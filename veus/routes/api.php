<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('v1/products', 'Api\ProductsController@index');
Route::middleware('auth:api')->post('v1/products', 'Api\ProductsController@store');
Route::middleware('auth:api')->get('v1/products/{id}', 'Api\ProductsController@show');
Route::middleware('auth:api')->put('v1/products/{id}', 'Api\ProductsController@update');
Route::middleware('auth:api')->delete('v1/products/{id}', 'Api\ProductsController@destroy');

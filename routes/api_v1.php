<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'Api\AuthController@login');

Route::group(['middleware' => 'apiJWT'], function () {
    Route::post('auth/logout', 'Api\AuthController@logout');
    Route::resource('products', 'Api\v1\ProductController');

    /*Route::get('products',         'Api\v1\ProductController@searchProduct');
    Route::post('products',        'Api\v1\ProductController@store');
    Route::patch('products/{id}',  'Api\v1\ProductController@update');
    Route::delete('products/{id}', 'Api\v1\ProductController@destroy');*/
});

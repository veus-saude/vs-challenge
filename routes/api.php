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

Route::post('v1/auth/login', 'Api\V1\AuthController@login');

Route::group(['middleware' => ['apiJwt']], function() {
    
    Route::post('v1/auth/me', 'Api\V1\AuthController@me');
    Route::post('v1/auth/logout', 'Api\V1\AuthController@logout');
    
    Route::resource('v1/products', 'Api\V1\ProductController')
        ->only('index', 'show', 'store', 'update', 'destroy');
});

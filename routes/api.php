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

Route::group(['prefix' => 'v1'], function () {
    //
    Route::post('/signin', 'Api\v1\AuthController@signin');
    Route::post('/signup', 'Api\v1\UserController@store');
    //
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/user', 'Api\v1\UserController@index');
        Route::get('/signout', 'Api\v1\AuthController@signout');
        // Product
        Route::post('/products', 'Api\v1\ProductController@store');
        Route::get('/products', 'Api\v1\ProductController@index');
        Route::get('/product/{id}', 'Api\v1\ProductController@show');
        Route::put('/product/{id}', 'Api\v1\ProductController@update');
        Route::delete('/product/{id}', 'Api\v1\ProductController@destroy');
    });
});

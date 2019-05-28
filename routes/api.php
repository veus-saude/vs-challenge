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

Route::group(['middleware' => 'api', 'prefix' => 'v1/auth'], function () {

    Route::post('authenticate', 'AuthController@authenticate')->name('api.v1.authenticate');
    Route::post('register', 'AuthController@register')->name('api.v1.register');
});

Route::group(['middleware' => ['api','auth'],'prefix' => 'v1/product'],function (){
    Route::get('search/','SearchProductController@search')->name('product.v1.search');
});

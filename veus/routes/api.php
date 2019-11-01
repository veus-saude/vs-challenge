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

Route::group(['middleware' => 'auth:api'],function (){

    Route::get('products','ProductController@index');
    Route::get('products/{product}','ProductController@show');
    Route::put('products/{product}','ProductController@update');
    Route::delete('products/{product}','ProductController@destroy');

});
Route::get('search','ProductController@search');
Route::post('products','ProductController@store');
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

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


Route::get('login',function (){
    return "Pagina de Login";
})->name('login');


Route::prefix('v1')->group(function (){
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');


    Route::group(['middleware' => 'auth:api'],function (){

        Route::put('products/{product}','ProductController@update');
        Route::delete('products/{product}','ProductController@destroy');
        Route::post('products','ProductController@store');
        Route::get('products/{product}','ProductController@show');
        Route::get('logout', 'Auth\LoginController@logout');
        Route::get('products','ProductController@index');
    });

});




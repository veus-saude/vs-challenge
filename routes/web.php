<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/save', ['uses' => 'UsuarioController@index', 'name' => 'usuario.save']);
Route::post('/token', ['uses' => 'UsuarioController@token', 'name' => 'usuario.token']);

Route::group([
    'middleware' => ['jwt.auth'],
    'namespace'  => '\App\Http\Controllers\Api\V1',
    'prefix'     => 'api/v1',
], function () {
    Route::group([ 'prefix' => 'products'], function(){
        Route::get('/', ['uses' => 'ProductApiController@index', 'name' => 'api.v1.products']);

        Route::post('/', ['uses' => 'ProductApiController@cadastrar', 'name' => 'api.v1.products.save']);
        Route::delete('/{id}/', ['uses' => 'ProductApiController@delete', 'name' => 'api.v1.products.delete']);
        Route::get('/{id}/', ['uses' => 'ProductApiController@findone', 'name' => 'api.v1.products.findone']);
        Route::put('/{id}/', ['uses' => 'ProductApiController@update', 'name' => 'api.v1.products.update']);
    });
});

/*
Route::group([ 'prefix' => 'api'], function(){
    Route::group([ 'prefix' => 'v1'], function(){

    });
});
*/

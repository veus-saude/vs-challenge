<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return 'Desafio Veus';
});

Route::group(['prefix' => 'v1'], function(){
    /**
     * Autenticação e Login
     */
    Route::group(['prefix' => 'auth'], function(){
        Route::post('/user',        ['uses' => 'AuthController@authenticate',  'as' => 'auth.admin']);
        Route::post('/register',    ['uses' => 'AuthController@register',      'as' => 'auth.register']);
    });

    /**
     * Disponíveis apenas com o Bearer Token no HEADER
     */
    Route::group(['middleware' => 'jwt.auth'], function(){

        /**
         * Marcas
         */
        Route::group(['prefix' => 'brands'], function(){
            Route::get('/',         ['uses' => 'BrandController@index',       'as' => 'brand.list']);
            Route::put('/{id}',     ['uses' => 'BrandController@update',      'as' => 'brand.update']);
            Route::delete('/{id}',  ['uses' => 'BrandController@delete',      'as' => 'brand.delete']);
            Route::post('/',        ['uses' => 'BrandController@create',      'as' => 'brand.create']);
        });

        /**
         * Produtos
         */
        Route::group(['prefix' => 'products'], function(){
            Route::get('/',         ['uses' => 'ProductController@index',       'as' => 'product.list']);
            Route::put('/{id}',     ['uses' => 'ProductController@update',      'as' => 'product.update']);
            Route::delete('/{id}',  ['uses' => 'ProductController@remove',      'as' => 'product.delete']);
            Route::post('/',        ['uses' => 'ProductController@create',      'as' => 'product.create']);
        });
    });
});
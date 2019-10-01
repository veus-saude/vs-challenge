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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'api/v1'], function() {
    Route::get('products', 'ProductsController@list');
    Route::get('products/{id}', 'ProductsController@detail');
    Route::put('products/{id}', 'ProductsController@update');
    Route::post('products', 'ProductsController@create');
    Route::delete('products/{id}', 'ProductsController@delete');
});

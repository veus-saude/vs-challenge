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
$router->group(['prefix' => 'api', 'middleware' => ['cors']], function () use ($router) {
    $router->post('auth',  ['uses' => 'UsersController@login']);
});

$router->group(['prefix' => 'api', 'middleware' => ['cors']], function () use ($router) {

    $router->get('users',  ['uses' => 'UsersController@findAll']);

    $router->get('users/findByName',  ['uses' => 'UsersController@findByNameOrUsername']);

    $router->get('users/{id}', ['uses' => 'UsersController@findById']);

    $router->post('users', ['uses' => 'UsersController@create']);

    $router->put('users/{id}', ['uses' => 'UsersController@update']);
});

$router->group(['prefix' => 'api', 'middleware' => ['cors', 'auth']], function () use ($router) {

    $router->get('products',  ['uses' => 'ProductsController@findAll']);

    $router->get('products/filter',  ['uses' => 'ProductsController@findByFilter']);

    $router->get('products/{id}', ['uses' => 'ProductsController@findById']);

    $router->post('products', ['uses' => 'ProductsController@create']);

    $router->put('products/{id}', ['uses' => 'ProductsController@update']);

    $router->delete('products/{id}', ['uses' => 'ProductsController@destroy']);
});

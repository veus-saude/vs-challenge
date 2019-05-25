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

$router->group(['prefix' => 'products'],  function($router) {

    $router->get('/', 'ProductController@all');
    $router->get('/{id}', 'ProductController@get');
    $router->post('/', 'ProductController@create');
    $router->put('/{id}', 'ProductController@update');
    $router->delete('/{id}', 'ProductController@delete');

});

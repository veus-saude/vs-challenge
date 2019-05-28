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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('auth/login', 'AuthController@authenticate');

$router->group(['prefix' => 'api/v1', 'middleware' => 'jwt.auth'], function () use ($router) {
    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->post('', 'v1\ProductsController@store');
        $router->get('', 'v1\ProductsController@index');
        $router->get('{id}', 'v1\ProductsController@show');
        $router->put('{id}', 'v1\ProductsController@update');
        $router->delete('{id}', 'v1\ProductsController@destroy');
    });
}
);

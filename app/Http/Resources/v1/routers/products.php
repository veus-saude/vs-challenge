<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'middleware' => [\App\Http\Middleware\JwtMiddleware::class],
], function($router) {

    /** @var \Laravel\Lumen\Routing\Router $router */

    $router->get('/products', 'ProductsController@search');

    $router->post('/products', 'ProductsController@create');

    $router->get('/products/{id}', 'ProductsController@search');

    $router->put('/products/{id}', 'ProductsController@update');

    $router->delete('/products/{id}', 'ProductsController@delete');
});


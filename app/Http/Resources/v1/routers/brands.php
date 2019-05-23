<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'middleware' => [\App\Http\Middleware\JwtMiddleware::class],
], function($router) {

    /** @var \Laravel\Lumen\Routing\Router $router */

    $router->get('/brands', 'BrandsController@search');

    $router->post('/brands', 'BrandsController@create');

    $router->get('/brands/{id}', 'BrandsController@search');

    $router->put('/brands/{id}', 'BrandsController@update');

    $router->delete('/brands/{id}', 'BrandsController@delete');
});


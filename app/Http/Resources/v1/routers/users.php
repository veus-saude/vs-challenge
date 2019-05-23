<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/users', 'UsersController@search');

$router->group([
    'middleware' => [\App\Http\Middleware\JwtMiddleware::class],
], function($router) {

    /** @var \Laravel\Lumen\Routing\Router $router */

    $router->post('/users', 'UsersController@create');

    $router->get('/users/{id}', 'UsersController@search');

    $router->put('/users/{id}', 'UsersController@update');

    $router->delete('/users/{id}', 'UsersController@delete');
});


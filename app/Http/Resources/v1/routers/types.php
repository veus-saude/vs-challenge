<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([
    'middleware' => [\App\Http\Middleware\JwtMiddleware::class],
], function($router) {

    /** @var \Laravel\Lumen\Routing\Router $router */

    $router->get('/types', 'TypesController@search');

    $router->post('/types', 'TypesController@create');

    $router->get('/types/{id}', 'TypesController@search');

    $router->put('/types/{id}', 'TypesController@update');

    $router->delete('/types/{id}', 'TypesController@delete');
});


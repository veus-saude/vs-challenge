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

$router->group(['prefix', '/', 'middleware' => App\Http\Middleware\VersionControl::class], function ($router) {
    $router->post('/V{d}/auth', 'V{d}\AuthController@post');
    $router->put('/V{d}/auth', 'V{d}\AuthController@put');

    $router->post('/V{d}/user', 'V{d}\UserController@post');

    $router->group(['middleware' => ['auth:api', 'jwt.refresh']], function () use ($router) {
        $router->delete('/V{d}/auth', 'V{d}\AuthController@delete');
        $router->get('/V{d}/auth', 'V{d}\AuthController@get');

        $router->get('/V{d}/products', 'V{d}\ProductController@query');
        $router->get('/V{d}/brands', 'V{d}\BrandController@getAll');

        $router->put('/V{d}/user/{id}', 'V{d}\UserController@put');
    });
});

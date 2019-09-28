<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);
$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function (Router $api) {
        $api->group(['prefix' => 'auth'], function (Router $api) {
            $api->post('register', 'SignUpController@signUp');
            $api->post('login', 'LoginController@login');
            $api->post('recovery', 'ForgotPasswordController@sendResetEmail');
            $api->post('reset', 'ResetPasswordController@resetPassword');
            $api->post('logout', 'LogoutController@logout');
            $api->post('refresh', 'RefreshController@refresh');
            $api->get('me', 'UserController@me');
        });

        $api->group(['middleware' => 'jwt.auth'], function (Router $api) {
            $api->get('users', 'UserController@index');
            $api->resource('products', 'ProductController');
        });


    });

    // versioning sample
    $api->get('version', function () {
        return response()->json(['message' => 'Version 1']);
    });
});

// versioning sample
$api->version('v2', function (Router $api) {
    $api->get('version', function () {
        return response()->json(['message' => 'Version 2']);
    });
});
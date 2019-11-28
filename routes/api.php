<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1', 'namespace'  => 'Api\v1', 'middleware' => 'api.version:1'], function() {
    
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'Auth\AuthController@login');
        Route::post('signup', 'Auth\AuthController@signup');
        
        Route::group(['middleware' => 'auth:api'], function() {
            Route::get('logout', 'Auth\AuthController@logout');
        });
    });
    
    Route::group(['middleware' => 'auth:api'], function() {
        Route::apiResources([
            'products' => 'ProductController',
            'brands'   => 'BrandController'
        ]);
    });
});
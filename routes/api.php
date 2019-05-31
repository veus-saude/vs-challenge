<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
//    Route::resource('product', 'ProductController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    Route::post('login', 'AuthController@login', ['as' => 'login']);
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    Route::group(['prefix' => 'product', 'as' => 'product::', 'middleware' => 'auth:api'], function () {
        Route::get    ('/',     ['uses' => 'ProductController@index'  , 'as' => 'index'   ]);
        Route::post   ('/',     ['uses' => 'ProductController@store'  , 'as' => 'create'  ]);
        Route::get    ('/{id}', ['uses' => 'ProductController@show'   , 'as' => 'show'    ]);
        Route::post   ('/{id}', ['uses' => 'ProductController@update' , 'as' => 'update'  ]);
        Route::delete ('/{id}', ['uses' => 'ProductController@destroy', 'as' => 'destroy' ]);
    });
});
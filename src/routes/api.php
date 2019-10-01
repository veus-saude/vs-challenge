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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'v1', 'namespace' => '\App\Http\Controllers\v1'], function () {

    //Resource Route for API CRUD
    Route::apiResource('products', 'ProductController');

    Route::get('/brands', 'BrandController@index');

});

// API v2 routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'v2', 'namespace' => '\App\Http\Controllers\v2'], function () {

    //Resource Route for API CRUD
    Route::apiResource('products', 'ProductController');

    Route::get('/brands', 'BrandController@index');

});

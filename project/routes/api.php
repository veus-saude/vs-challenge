<?php

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

use Illuminate\Support\Facades\Route;

Route::post('v1/register', [
	'as' => 'register', 
	'uses' => 'API\v1\UserController@register'
]);
Route::post('v1/login', [
	'as' => 'login',
	'uses' => 'API\v1\UserController@login',
]);

Route::middleware('auth:api')->group(function () {
    Route::resource('v1/products', 'API\v1\ProductController');
});
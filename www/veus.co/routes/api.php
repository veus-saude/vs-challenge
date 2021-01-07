<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('/v1/register', 'App\Http\Controllers\API\AuthController@register');
Route::post('/v1/login', 'App\Http\Controllers\API\AuthController@login');

Route::apiResource('/v1/products', 'App\Http\Controllers\API\ProductController')->middleware('auth:api');
Route::get('/v0/products', 'App\Http\Controllers\API\ProductV0Controller@index');
Route::get('/v0/products/search', 'App\Http\Controllers\API\ProductV0Controller@search');

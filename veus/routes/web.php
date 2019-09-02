<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/api/v1/products', ['middleware'=>'auth', 'uses'=>'Products@index']);

Route::pattern('id', '[0-9]+');
Route::get('/api/v1/products/{id}', ['middleware'=>'auth', 'uses'=>'Products@show']);
//Route::get('/api/v1/products/{id}', 'Products@show');

Route::get('/api/v1/products/{q?}/{filter?}', ['middleware'=>'auth', 'uses'=>'Products@index']);
//Route::get('/api/v1/products/{q?}/{filter?}', 'Products@index');

Route::post('/api/v1/products', ['middleware'=>'auth', 'uses'=>'Products@store']);
//Route::post('/api/v1/products', 'Products@store');
Route::post('/api/v1/products/{id}', ['middleware'=>'auth', 'uses'=>'Products@update']);
//Route::post('/api/v1/products/{id}', 'Products@update');
Route::delete('/api/v1/products/{id}', ['middleware'=>'auth', 'uses'=>'Products@destroy']);
//Route::delete('/api/v1/products/{id}', 'Products@destroy');

Route::get('403', 'Products@forbidden')->name('login');



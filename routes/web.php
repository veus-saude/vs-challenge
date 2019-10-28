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

/*Route::get('/', function () {
    return view('products/index');
});*/

Route::get('/products/index', 'ProductsController@index')->middleware('auth');

Route::resource('products', 'ProductsController')->middleware('auth');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'ProductsController@index')->middleware('auth');

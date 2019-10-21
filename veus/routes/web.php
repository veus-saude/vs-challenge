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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products','ProdutosController@view')->middleware('auth');
Route::get('/products/new','ProdutosController@new')->middleware('auth');
Route::get('/products/edit/{id}','ProdutosController@edit')->middleware('auth');
Route::post('/products','ProdutosController@store')->middleware('auth');
Route::put('/products/{id}','ProdutosController@update')->middleware('auth');
Route::get('/products/{id}','ProdutosController@delete')->middleware('auth');


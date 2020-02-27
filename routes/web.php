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

// ROTAS PARA REGISTRO DO USUÁRIO
Route::get('/',['uses' => 'RegisterController@index'])->name('index');
Route::post('/register',['uses' => 'RegisterController@register'])->name('register');

// ROTAS PARA LOGIN DO USUÁRIO
Route::get('/login',['uses' => 'LoginController@index'])->name('login');
Route::post('/logon',['uses' => 'LoginController@logon'])->name('logon');

// ROTAS DA API
Route::get('/show',['uses' => 'ProductController@show','middleware' => 'auth.user' , function(){}])->name('show');
Route::get('/store',['uses' => 'ProductController@store','middleware' => 'auth.user' , function(){}])->name('store');
Route::get('/update',['uses' => 'ProductController@update','middleware' => 'auth.user' , function(){}])->name('update');
Route::get('/delete',['uses' => 'ProductController@delete','middleware' => 'auth.user' , function(){}])->name('delete');
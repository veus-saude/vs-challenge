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


Route::get('/settings', 'SettingsController@index')->name('settings');
Auth::routes(['verify' => true]);

Route::get('/home', 'ProductSiteController@index')->name('home');


Route::get('/produtos/search/', 'ProductSiteController@search')->name('produtos.search');

Route::resources([
    'produtos' => 'ProductSiteController'
]);
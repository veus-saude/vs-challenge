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

$router->get('/', 'ProductController@home');
$router->get('/add', 'ProductController@add');
$router->post('/add', 'ProductController@addStore');
$router->get('/edit/{product_id}', 'ProductController@edit')->name('edit');
$router->post('/edit/{product_id}', 'ProductController@editStore')->name('edit');
$router->get('/delete/{product_id}', 'ProductController@delete');

$router->get('brand/', 'BrandController@home');
$router->get('brand/add', 'BrandController@add');
$router->post('brand/add', 'BrandController@addStore');
$router->get('brand/edit/{product_id}', 'BrandController@edit')->name('brand.edit');
$router->post('brand/edit/{product_id}', 'BrandController@editStore')->name('brand.edit');

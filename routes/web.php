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
$router->get('/edit', 'ProductController@edit');
$router->post('/edit', 'ProductController@editStore');
$router->post('/delete', 'ProductController@delete');

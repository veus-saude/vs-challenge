<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('login');
});
Route::prefix('admin')->group(function () {
    Route::get('cadastro_produtos', function () {
        return view('cadastro_produtos');
    })->name('cadastro_produtos');

    Route::get('editar_produtos/{id}', function () {
        return view('editar_produtos');
    })->name('editar_produtos');

    Route::get('listagem', function () {
        return view('admin_listagem');
    })->name('admin_listagem');
});

Route::get('site', function () {
    return view('site');
})->name('site');

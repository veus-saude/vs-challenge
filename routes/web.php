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

//usuario
Route::get('cadastro','CadastroController@cadastro')->name('cadastro');

Route::post('cadastrar','CadastroController@cadastrar')->name('cadastrar');

Route::get('login', function () { return view('auth.login'); });

Route::post('busca', 'CadastroController@busca')->name('busca');

/**
 * após a criação do novo usuário
 * redirecionar o usuario para página
 * pós cadastro
 *
 * @return view
 */

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

Route::get('/home','CadastroController@home')->name('home');

Route::get('cadastro_produto','CadastroController@cadastro_produto')->name('cadastro_produto');

Route::post('cadastrar_produto','CadastroController@cadastrar_produto')->name('cadastrar_produto');

Route::get('altera_produto','CadastroController@altera_produto')->name('altera_produto');

Route::post('alterar_produto','CadastroController@alterar_produto')->name('alterar_produto');

Route::post('excluir_produto','CadastroController@excluir_produto')->name('excluir_produto');

Route::get('cadastro_estoque','CadastroController@cadastro_estoque')->name('cadastro_estoque');

Route::post('cadastrar_estoque','CadastroController@cadastrar_estoque')->name('cadastrar_estoque');

});

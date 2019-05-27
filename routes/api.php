<?php

use Illuminate\Http\Request;

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    //Listar marcas
    Route::get('marcas', 'MarcaController@index');

    //Listar produtos
    Route::get('produtos', 'ProdutoController@index');

    //Listar UM produto
    Route::get('produto/{produto}', 'ProdutoController@show');

    //Criar um novo produto
    Route::post('produto', 'ProdutoController@store');

    //Atualizar um produto
    Route::put('produto/{produto}', 'ProdutoController@update');

    //Apagar um produto
    Route::delete('produto/{produto}', 'ProdutoController@destroy');
});

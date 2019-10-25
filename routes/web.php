<?php

/*
|--------------------------------------------------------------------------
| Aplicação de Rotas (Routes)
|--------------------------------------------------------------------------
||
*/

// Rota get HOME (FORMULÁRIO DE LOGIN)
Route::get('/', 'HomeController@getIndex')->name('login');

// Rota post HOME (FORMULÁRIO DE LOGIN)
Route::post('/autenticacao-login', 'HomeController@postLogin')->name('autenticacao-login');

// Rota get ENCERRAR SESSÃO
Route::get('/encerrar-sessao', 'HomeController@getEncerrarSessao')->name('encerrar-sessao');
    
// Rout grupo de rota com filtro para autenticação. Só será acessado por autenticação 
Route::group(['middleware'=>['auth']], function(){
    
    
    Route::get('/logout', function (){
       Auth::logout();
       return redirect()->route('login');
    });     
    
    
     // Rota get LOG DO SISTEMA
    Route::get('/index-log', 'ProdutoController@getIndexLog')->name('index-log');
    
    //Painel acessado somente para quem tem direito de logar no sistema
    Route::get('/painel', 'HomeController@painel')->name('painel');    
    
    // Rota get CADASTRAR PRODUTO
    Route::get('/cadastrar-produto', 'ProdutoController@getCadastrarProduto')->name('cadastrar-produto');
    
    // Rota get LISTAGEM DE PRODUTOS
    Route::get('/produto', 'ProdutoController@getProduto')->name('produto');

    // Rota post CADASTRAR PRODUTO
    Route::post('/agregar', 'ProdutoController@postStore')->name('store');

    // Rota get VISUALIZAR PRODUTO
    Route::get('/visualizar-produto/{id}', 'ProdutoController@getVisualizarProduto')->name('visualizar-produto');
    
    // Rota get EDITAR PRODUTO
    Route::get('/editar/{id}', 'ProdutoController@getEditar')->name('editar');

    // Rota post UPDATE PRODUTO
    Route::post('/update/{id}', 'ProdutoController@postUpdate')->name('update');

    // Rota delete REMOVER PRODUTO
    Route::delete('/remover-produto/{id}', 'ProdutoController@destroy')->name('remover-produto');

    // Rota get INATIVAR PRODUTO
    Route::get('/inativar-produto/{id}', 'ProdutoController@getInativarProduto')->name('inativar-produto');

    // Rota post INATIVAR PRODUTO
    Route::post('/inativar-convenio', 'ProdutoController@postInativarProduto')->name('inativar-produto');
    
     // Rota get LISTAGEM DE PRODUTOS INATIVOS
    Route::get('/index-produto-inativo', 'ProdutoController@getIndexProdutoInativo')->name('index-produto-inativo');
    
    // Rota get REATIVAR PRODUTO
    Route::get('/reativar-produto/{id}', 'ProdutoController@getReativarProduto')->name('reativar-produto');
    
    // Rota post REATIVAR PRODUTO
    Route::post('/reativar-convenio', 'ProdutoController@postReativarProduto')->name('reativar-produto');
    
    Route::get('/escopo-pesquisa', 'HomeController@getEscopoPesquisa')->name('escopo-pesquisa');
});


<?php




Route::group(['prefix' => 'api'], function()
{
    Route::group(['prefix' => 'v1'], function()
    {
        Route::get('/produtos','ListaProdutoController@index');        
    });
    
});


Route::get('/', function(){
    return view('home');
});
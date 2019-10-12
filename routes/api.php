<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix("/v1")->group(function () {

  Route::get('/list', "Api\V1\ProdutosController@list");
  Route::get('/search', "Api\V1\ProdutosController@search");
  Route::post('/insert', "Api\V1\ProdutosController@insert");
  Route::post('/update', "Api\V1\ProdutosController@update");
  Route::delete('/delete/{id}', "Api\V1\ProdutosController@delete");

});



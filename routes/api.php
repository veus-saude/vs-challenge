<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
  Route::apiResources([
    'produtos' => 'ProdutoController'
  ], ['except' => 'index']);
});


Route::prefix('auth')->group(function(){
  Route::post('registro','AutenticadorController@registro');
  Route::post('login','AutenticadorController@login');

  Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout','AutenticadorController@logout');
  });
});
Route::get('produtos','ProdutoController@index');
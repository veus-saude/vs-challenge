<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas de API para seu aplicativo. Estes
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| é designado ao grupo de middleware "api".
|
*/
Route::prefix('auth')->middleware('api')->group(function(){
    Route::post('/register', 'Apis\V1\Auth\AuthController@register');
    Route::post('/login', 'Apis\V1\Auth\AuthController@login');
    Route::middleware('api.auth')->get('/user', 'Apis\V1\Auth\AuthController@user');
    Route::middleware('api.auth')->get('/logout', 'Apis\V1\Auth\AuthController@logout');
    Route::middleware('api.auth')->get('/refresh', 'Apis\V1\Auth\AuthController@refresh');
});

Route::resource('products', 'Apis\V1\ProductController')
->middleware(['api', 'api.auth'])
->only(['index', 'show', 'store', 'update', 'destroy']);

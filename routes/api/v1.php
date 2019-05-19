<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API version 1 Routes
|--------------------------------------------------------------------------
|
| First API version!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', 'ApiProductController')->only([
    'index'
]);
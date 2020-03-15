<?php

Route::post('/user/create', [
    'as' => 'user.create',
    'uses' => 'Api\V2\UserController@create',
]);

Route::middleware('auth:api')->group(function () {
    Route::resource('product', 'Api\V2\ProductController');
    Route::resource('brand', 'Api\V2\BrandController');
});

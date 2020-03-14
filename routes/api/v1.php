<?php

Route::post('/user/create', [
    'as' => 'user.create',
    'uses' => 'Api\V1\UserController@create',
]);

Route::middleware('auth:api')->group(function () {
    Route::resource('product', 'Api\V1\ProductController');
});


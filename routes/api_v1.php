<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products', 'Api\v1\ProductController@searchProduct');
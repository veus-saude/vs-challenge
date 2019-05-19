<?php

namespace App\Http\Controllers\ApiV1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends ApiController
{
	protected $model = Product::class;
    // protected $transformer = EdicoesDigitaisTiposTransformer::class;
    //
}

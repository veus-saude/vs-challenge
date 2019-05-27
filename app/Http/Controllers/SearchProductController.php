<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Product\ProductRepository;
use Response;


class SearchProductController extends Controller
{

    private $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo=$productRepo;
    }

    public function search(Request $request){
    	return $this->productRepo->searchProduct();
    }
}

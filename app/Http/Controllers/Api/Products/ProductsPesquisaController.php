<?php

namespace App\Http\Controllers\Api\Products;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class ProductsPesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $name = Request::query('name');
      $brand = Request::query('brand');
      $price = Request::query('price');
      $amount = Request::query('amount');

      dd($name);

      

    }
}

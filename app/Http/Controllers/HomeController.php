<?php

namespace App\Http\Controllers;

use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::count();
        
        $chartData = Product::chartData();
        
        return view('home', ['products' => $products, 'chartData' => $chartData]);
    }
}

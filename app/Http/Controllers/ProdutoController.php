<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {
        return view('produtos.index');
    }

    public function login(){
        return view('login.index');
    }


}

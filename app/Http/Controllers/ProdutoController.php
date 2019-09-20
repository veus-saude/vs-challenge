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

    public function getData()
    {
        $model   = Produto::searchPaginateAndOrder();
        $columns = Produto::$columns;

        return response()->json([
            'model' => $model,
            'columns' => $columns,
        ]);
    }

}

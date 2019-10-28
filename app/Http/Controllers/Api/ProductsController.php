<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $nome = $request->nome;
        $marca = $request->marca;
        $preco = $request->preco;
        $estoque = $request->estoque;
        
        $perPage = 25;

        if (!empty($nome)) {
            $products = Product::where('nome', 'LIKE', "%$nome%")
                    ->latest()->paginate($perPage);
        }elseif(!empty($nome) && !empty($marca)){
            $products = Product::where('nome', 'LIKE', "%$nome%")
                ->orWhere('marca', 'LIKE', "%$marca%")
                    ->latest()->paginate($perPage);
        }elseif(!empty($nome) && !empty($marca) && !empty($preco)){
            $products = Product::where('nome', 'LIKE', "%$nome%")
                ->orWhere('marca', 'LIKE', "%$marca%")
                ->orWhere('preco', 'LIKE', "%$preco%")
                    ->latest()->paginate($perPage);
        }elseif(!empty($nome) && !empty($marca) && !empty($preco) && !empty($estoque)){
            $products = Product::where('nome', 'LIKE', "%$nome%")
                ->orWhere('marca', 'LIKE', "%$marca%")
                ->orWhere('preco', 'LIKE', "%$preco%")
                ->orWhere('estoque', 'LIKE', "%$estoque%")
                ->latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }

        return response()->json(['products'=>$products], 200);
    }
}

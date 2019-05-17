<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutosController extends Controller {
    
    public function view(Request $request) {
        
        if($request->has("q") && $request->has("filter")) {
            $campoExtra = explode(":", $request->input("filter"));
            $lista = Produto::select("name", "brand", "value", "stock")
                        ->where("name", "like", "%" . $request->input("q") . "%")
                        ->where($campoExtra[0], "like", $campoExtra[1])
                        ->paginate(10);
            
        } elseif($request->has("q")) {
            $lista = Produto::select("name", "brand", "value", "stock")
                        ->where("name", "like", "%" . $request->input("q") . "%")
                        ->paginate(10);
        } else {
            $lista = Produto::select("name", "brand", "value", "stock")
                        ->paginate(10);
        }
        
        return response()->json($lista);
    }
}

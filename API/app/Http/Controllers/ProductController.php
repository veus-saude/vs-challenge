<?php
 
namespace App\Http\Controllers;
 
use App\Product;
use Illuminate\Http\Request;
 
class ProductController extends Controller
{
    public function index(Request $request){
        $input      = $request->all();
        $products   = Product::searchString($input)
                        ->filterField($input)
                        ->sortField($input)
                        ->paginate(5);
 
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
 
    public function show($id){
        $product = auth()->user()->products()->find($id);
 
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produto '.$id.' não encontrado'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $product->toArray()
        ], 400);
    }
 
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer'
        ]);
 
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
 
        if (auth()->user()->products()->save($product))
            return response()->json([
                'success' => true,
                'data' => $product->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Produto não pôde ser adicionado'
            ], 500);
    }
 
    public function update(Request $request, $id){
        $product = auth()->user()->products()->find($id);
 
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produto '.$id.' não encontrado'
            ], 400);
        }
 
        $updated = $product->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Produto não foi atualizado'
            ], 500);
    }
 
    public function destroy($id){
        $product = auth()->user()->products()->find($id);
 
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produto '.$id.' não encontrado'
            ], 400);
        }
 
        if ($product->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produto não pôde ser deletado'
            ], 500);
        }
    }
}
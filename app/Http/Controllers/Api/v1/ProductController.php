<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Api\v1\Product;
use Exception;
use Log;

class ProductController extends Controller
{
    
    public $product;
    
    public function __construct() {
        $this->product = new Product();
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $products = $this->product->index($request);
            return response()->json($products);
        } catch (Exception $e) {
            
            $error = json_encode([
                'error'   => 'Erro ao tentar listar produtos',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Não foi possível listar produtos, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            // Get all data from request
            $data = $request->all();
            
            // Insert product into products table
            $created = Product::create($data);
            
            // Return Response
            return response()->json($created);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar cadastrar produto',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar cadastrar produto, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Get product from database into a eloquent object
            $product = Product::find($id);
            
            if (!$product) {
                throw new Exception("Produto não encontrado");
            }
            
            // Return Response
            return response()->json($product);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar detalhar produto',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar detalhar produto, entre em contato com o suporte Veus'
            ], 500);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            // Get product from database into a eloquent object
            $product = Product::find($id);
            
            if (!$product) {
                throw new Exception("Produto não encontrado");
            }
            
            // Get all data from request
            $data = $request->all();
            
            // update product into products table
            $product->update($data);
            
            // Return Response
            return response()->json($product);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar atualizar produto',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar atualizar produto, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            // Get product from database into a eloquent object
            $product = Product::find($id);
            
            if (!$product) {
                throw new Exception("Produto não encontrado");
            }
            
            // delete product from products table
            $product->delete();
            
            // Return Response
            return response()->json([
                'success' => true,
                'message' => 'Produto excluído com sucesso'
            ]);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar excluir produto',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar atualizar produto, entre em contato com o suporte Veus'
            ], 500);
        }
    }
}

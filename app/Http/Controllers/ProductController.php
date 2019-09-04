<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductController constructor.
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        return $this->productService->all($request);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand_id' => 'required | integer | exists:brands,id',
            'price' => 'required | numeric | min:0',
            'qty' => 'required | numeric | min:0'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }

        $product = $this->productService->create($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => 'Produto criado com sucesso.',
            'data'      => $product
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand_id' => 'required | integer | exists:brands,id',
            'price' => 'required | numeric | min:0',
            'qty' => 'required | numeric | min:0'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }

        try{
            $product = $this->productService->get($id);
            $update = $this->productService->update($request->all(), $id);

            return response()->json([
                'status'    => 'success',
                'message'   => 'Produto "'.$product->name.'" atualizado com sucesso.',
                'data'      => $update
            ], Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return \response()->json([
                'status' => 'error',
                'message' => 'Não foi possível atualizar o produto.',
                'debug' => $e->getMessage()
            ]);
        }
    }

    public function remove($id)
    {
        $product = $this->productService->get($id);
        if($product){

            $delete = $this->productService->delete($id);

            return \response()->json([
                'status' => 'success',
                'message' => 'O produto "'.$product->name.'" foi removido com sucesso.',
                'delete' => $delete
            ], Response::HTTP_OK);
        }else{
            return \response()->json([
                'status' => 'error',
                'message' => 'O produto que você está tentando excluir não existe.'
            ]);
        }
    }
}

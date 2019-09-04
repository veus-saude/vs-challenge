<?php
/**
 * Desenvolvido por: Lucas Maia - lucas.codemax@gmail.com
 * WhatsApp: (21) 96438-6937
 *
 * Criado em: 28/08/19 17:13
 * Projeto: Desafio Veus
 */

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * ProductService constructor.
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all(Request $request)
    {
        $products = Product::query();

        if($request->has('q'))
        {
            $products->where('name', 'LIKE', "%$request->q%");
        }

        if($request->has('filter'))
        {
            $filter = explode(':', $request->filter);

            if($filter[0] == "brand"){
                $products->whereHas('brand', function($query) use ($filter){
                    $query->where('name', 'like', "%$filter[1]%");
                });
            }
        }

        if($request->has('sort'))
        {
            $sort = explode(':', $request->sort);
            if(count($sort) > 1){
                $products->orderBy($sort[0], $sort[1]);
            }else{
                $products->orderBy($sort[0], 'ASC');
            }
        }

        return $products->paginate(20);
    }

    public function get($id)
    {
        $product = Product::query()->where(['id' => $id])->get();
        if($product->isNotEmpty())
        {
            return $product->first();
        }else{
            return FALSE;
        }
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function create($params = array())
    {
        DB::beginTransaction();
        try{
            $product = $this->productRepository->create($params);
            DB::commit();

            return $product;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function update(array $params, $id)
    {
        DB::beginTransaction();
        try{
            $product = $this->productRepository->update($params, $id);
            DB::commit();

            return $product;
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
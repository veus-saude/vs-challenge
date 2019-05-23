<?php


namespace App\Http\Resources\v1\Controllers;

use App\Source\Produtcs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Lumen\Routing\Controller;

class ProductsController extends Controller
{
    public function search(Request $request, $id = null)
    {
        $products = Produtcs::join('types', 'products.id_type', '=', 'types.id')
            ->join('brands', 'products.id_brand', '=', 'brands.id')
            ->select([
                'products.id',
                'brands.name as brand',
                'types.name as type',
                'products.name as name',
            ]);

        if($id)
        {
            $this->appendProductFilter($products, "id", $id);
        }

        if($request->has('q'))
        {
            $this->appendProductFilter($products, "type", $request->input('q'));
        }

        if($request->has('filter'))
        {
            $list_filters = is_array($request->input('filter')) ? $request->input('filter') : [$request->input('filter')];
            foreach($list_filters as $filter_item){
                list($filter, $filter_search) = explode(":",$filter_item);
                $this->appendProductFilter($products, $filter, $filter_search);
            }
        }

        if($id)
        {
            return response()->json($products->first(), 200);
        }
        return response()->json(
            $products->paginate(15)
                    ->appends(Input::except('page')
            ), 200);
    }

    public function appendProductFilter(&$db, $filter, $value)
    {
        switch (strtolower($filter))
        {
            case "id":
                $db->where('products.id', $value);
            break;
            case "brand":
                $db->where('brands.name', $value);
            break;
            case "type":
                $db->where('types.name', $value);
            break;
        }
    }

    public function create(Request $request)
    {
        $validator = validator($request->input(), [
            'id_brand' => ['required', 'exists:brands,id'],
            'id_type' => ['required', 'exists:types,id'],
            'name' => ['required', 'unique:products,name'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $product = new Produtcs();
        $product->setIdBrand($request->input('id_brand'));
        $product->setIdType($request->input('id_type'));
        $product->setName($request->input('name'));

        $product->save();

        return response()->json([
            'id' => (int)$product->getId(),
            'id_brand' => (int)$product->getIdBrand(),
            'id_type' => (int)$product->getIdType(),
            'name' => $product->getName()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = validator(array_merge($request->input(), ['id' => $id]), [
            'id' => ['required', 'exists:products,id'],
            'id_brand' => ['exists:brands,id'],
            'id_type' => ['exists:types,id'],
            'name' => ['unique:products,name,'.$request->input('id').',id'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $product = Produtcs::find($id);
        $product->fill($request->input());

        if(!empty($product->getChanges())){
            $product->save();
        }

        return response()->json([
            'id' => (int)$product->getId(),
            'id_brand' => (int)$product->getIdBrand(),
            'id_type' => (int)$product->getIdType(),
            'name' => $product->getName()
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $validator = validator([
            'id' => $id
        ], [
            'id' => ['required', 'exists:products,id']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

       if(!Produtcs::where('id', $id)->delete()){
           return response()->json([
               "error" => [
                   'message' => 'Ops, algo deu errado, não foi possivel deletar o produto.'
               ]
           ], 400);
       }

        return response()->json([
            "message" => "Produto deletado com sucesso."
        ], 200);
    }
}
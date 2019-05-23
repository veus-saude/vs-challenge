<?php


namespace App\Http\Resources\v1\Controllers;

use App\Source\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Lumen\Routing\Controller;

class BrandsController extends Controller
{
    public function search(Request $request, $id = null)
    {
        $brands = Brands::select([
            'id',
            'name'
        ]);

        if($id)
        {
            $brands->where('id', $id);
        }

        if($id)
        {
            return response()->json($brands->first(), 200);
        }

        return response()->json(
            $brands->paginate(15)
                    ->appends(Input::except('page')
            ), 200);
    }


    public function create(Request $request)
    {
        $validator = validator($request->input(), [
            'name' => ['required', 'unique:brands,name'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $product = new Brands();
        $product->setName($request->input('name'));

        $product->save();

        return response()->json([
            'id' => (int)$product->getId(),
            'name' => $product->getName()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = validator(array_merge($request->input(), ['id' => $id]), [
            'id' => ['required', 'exists:brands,id'],
            'name' => ['unique:brands,name,'.$id.',id'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $brands = Brands::find($id);
        $brands->fill($request->input());

        if(!empty($brands->getChanges())){
            $brands->save();
        }

        return response()->json([
            'id' => (int)$brands->getId(),
            'name' => $brands->getName()
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $validator = validator([
            'id' => $id
        ], [
            'id' => ['required', 'exists:brands,id']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

       if(!Brands::where('id', $id)->delete()){
           return response()->json([
               "error" => [
                   'message' => 'Ops, algo deu errado, não foi possivel deletar.'
               ]
           ], 400);
       }

        return response()->json([
            "message" => "Deletado com sucesso."
        ], 200);
    }
}
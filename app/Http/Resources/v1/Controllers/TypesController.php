<?php


namespace App\Http\Resources\v1\Controllers;

use App\Source\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Lumen\Routing\Controller;

class TypesController extends Controller
{
    public function search(Request $request, $id = null)
    {
        $types = Types::select([
            'id',
            'name'
        ]);

        if($id)
        {
            $types->where('id', $id);
        }

        if($id)
        {
            return response()->json($types->first(), 200);
        }

        return response()->json(
            $types->paginate(15)
                ->appends(Input::except('page')
                ), 200);
    }


    public function create(Request $request)
    {
        $validator = validator($request->input(), [
            'name' => ['required', 'unique:types,name'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $types = new Types();
        $types->setName($request->input('name'));

        $types->save();

        return response()->json([
            'id' => (int)$types->getId(),
            'name' => $types->getName()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = validator(array_merge($request->input(), ['id' => $id]), [
            'id' => ['required', 'exists:types,id'],
            'name' => ['unique:types,name,'.$request->input('id').',id'],
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        $types = Types::find($id);
        $types->fill($request->input());

        if(!empty($types->getChanges())){
            $types->save();
        }

        return response()->json([
            'id' => (int)$types->getId(),
            'name' => $types->getName()
        ], 200);
    }

    public function delete(Request $request, $id)
    {
        $validator = validator([
            'id' => $id
        ], [
            'id' => ['required', 'exists:types,id']
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => [
                    "message" => $validator->getMessageBag()->getMessages()
                ]
            ],400);
        }

        if(!Types::where('id', $id)->delete()){
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
<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Requests\ProdutoRequest;
use App\Produto;
use App\Repositories\ProdutoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{
    /**

     * @var Produto
     */
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProdutoRepository $produtos)
    {

        // Caso tenha filtros para busca
        if($request->has('filter')){
            $produtos::condicoesDeBusca($request);
        }

        // Caso ordenacao
        if($request->has('order')){
            $produtos::ordenacao($request);
        }

        // Caso queira selecionar determinados campos
        if($request->has('fields')) {
            $produtos::selecionarCampos($request);
        }
        return response()->json($produtos->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $dados = $request->all();
        try{

            $produto = $this->produto->create($dados);

            return response()->json([
                'data' => [
                    'msg' => 'Produto cadastrado com sucesso!'
                ]
            ],200);

        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
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

        try{

            $produto = $this->produto->find($id);

            return response()->json([
                'data' => $produto
            ],200);

        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $dados = $request->all();

        try{

            $produto = $this->produto->create($id);
            $produto->update($dados);

            return response()->json([
                'data' => [
                    'msg' => 'Produto atualizado com sucesso!'
                ]
            ],200);

        }catch (\Exception $e){
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       try{

            $this->produto->findOrFail($id)->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Produto excluido com sucesso!\''
                ]
            ],200);

        }catch (\Exception $e){
           $message = new ApiMessages($e->getMessage());
           return response()->json($message->getMessage(), 401);
        }

    }
}

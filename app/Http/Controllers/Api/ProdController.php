<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\ModelProduto;
use Illuminate\Http\Request;

class ProdController extends Controller
{
    private $objProduto;

    public function __construct(ModelProduto $produto)
    {
        $this -> objProduto = $produto;
    }

   public function index()
    {
        $produto = $this->objProduto->paginate(2);
        return view('index', compact('produto'));
    }

    public function show($id)
    {
        $produto = $this->objProduto->find($id);
        return view('show', compact('produto'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ProdutoRequest $request)
    {
        $produtoData = $request->all();
        $cad = $this->objProduto->create($produtoData);
        if($cad){
            return redirect('api/produtos');
        }
    }

    public function edit($id)
    {
        $produto=$this->objProduto->find($id);
        return view('create', compact('produto'));
    }

    public function update(ProdutoRequest $request, $id)
    {
        $this->objProduto->where(['id'=>$id])->update([
            'name'=>$request->name,
            'brand'=>$request->brand,
            'price'=>$request->price,
            'quantity'=>$request->quantity
        ]);
        return redirect('api/produtos');
    }

    public function destroy($id)
    {
        $del = $this->objProduto->destroy($id);
        return ($del) ? "deletado" : "não deletado";
    }
}

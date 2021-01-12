<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\ModelProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private $objProduto;

    public function __construct()
    {
        $this -> objProduto = new ModelProduto();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produto = $this->objProduto->paginate(2);
        return view('index', compact('produto'));
        // dd($this->objProduto->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $cad = $this->objProduto->create([
            'name'=>$request->name,
            'brand'=>$request->brand,
            'price'=>$request->price,
            'quantity'=>$request->quantity
        ]);
        if($cad){
            return redirect('produtos');
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
        $produto=$this->objProduto->find($id);
        return view('show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto=$this->objProduto->find($id);
        return view('create', compact('produto'));
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
        $this->objProduto->where(['id'=>$id])->update([
            'name'=>$request->name,
            'brand'=>$request->brand,
            'price'=>$request->price,
            'quantity'=>$request->quantity
        ]);
        return redirect('produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = $this->objProduto->destroy($id);
        return ($del) ? "sim" : "não";
    }
}

<?php

namespace App\Http\Controllers\Api\Products;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->get()->count();
       // dd($products);            

          if($products > 0){

          $usersRegistered = DB::table('products')
            ->get();

            return response()->json(['usersRegistered' => $usersRegistered, 'amount' => $products]);

          }else{
            return response()->json(['message' => 'Não constam produtos cadastrados em nossa base de dados']);
          }
                  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $brand = $request->input('brand');

        $validacao = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'anount' => 'nullable|numeric',
        ]);

        if($name != '' && $brand != ''){
            

            $productsValidate = DB::table('products')
                                ->where('name', $name)
                                ->where('brand', $brand)
                                ->get()->count();
                                //dd($productsValidate);
            
            if($productsValidate <= 0){

                try {

                    $product = new Product;
                    $product->name = $request->name;
                    $product->brand = $request->brand;
                    $product->price = $request->price;
                    $product->amount = $request->amount;
                    $product->save();
            
                    return response()->json(['sucess' => 'Produto cadastrado com sucesso!']);
            
                    }catch (QueryException $e) {
                       // dd($e->errorInfo[2]);
                       return response()->json(['message' => $e->errorInfo[2]]);
                    }
            
            }else {
                return response()->json(['message' => 'Ops! Já existe um produto cadastrado com as mesmas especificações!']);
            }                    

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
        $productsValidate = DB::table('products')
                    ->where('id', $id)
                    ->get()->count();
        
            if($products > 0){
                $products = DB::table('products')
                    ->find($id);

                    return response()->json($products);
            }else {
                return response()->json(['message' => 'Ops! O ID informado não encontra-se cadastrado em nossa base de dados!']); 
            }      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // dd('estou aqui');
        $name = $request->input('name');
        $brand = $request->input('brand');
        $price = $request->input('price');
        $amount = $request->input('amount');

    

        if($name != '' && $brand != ''){
           // dd('estou aqui');

            $productsValidate = DB::table('products')
                                ->where('name', $name)
                                ->where('brand', $brand)
                                ->get()->count();
                               // dd($productsValidate);
            
            if($productsValidate <= 0){


                    $productsUpdate= DB::table('products')
                                     ->where('id', $id)
                                     ->update([
                                         'name' => $name,
                                         'brand' => $brand,
                                         'price' => $price,
                                         'amount' => $amount,
                                         ]);
            
                    return response()->json(['sucess' => 'Produto atualizado com sucesso!']);
            
                  
                    }else {
                        return response()->json(['message' => 'Ops! Já existe um produto cadastrado com as mesmas especificações!']);
                    }    
            
            }else {
                return response()->json(['message' => 'Ops! Campos obrigatórios sem preenchimento!']);
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

        $productsValidate = DB::table('products')
        ->where('id', $id)
        //->where('brand', $brand)
        ->get()->count();
        //dd($productsValidate);

       if($productsValidate > 0){

        $productsValidate = DB::table('products')
                        ->where('id', $id)
                        ->delete();

        return response()->json(['success' => 'Produto excluido com sucesso!']); 

       }else {
        return response()->json(['message' => 'Ops! O ID informado não encontra-se cadastrado em nossa base de dados!']); 
       }

        
    }
}

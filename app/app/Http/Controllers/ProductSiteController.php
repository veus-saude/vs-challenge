<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Validator;

class ProductSiteController extends Controller
{

    private $headers;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->headers = [
                'Authorization' => 'Bearer '.session('token'),
                'Accept' => 'application/json'
            ]; 
            
            return $next($request);
            });
        
    }

    public function index()
    {
        $response = (new Client())->get('http://localhost/api/v1/products', [
            'headers' => $this->headers
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return view('product.index', compact('response'));
    }


    public function search(Request $request)
    {
        $quertString = '';

        if(isset($request->q)) {
            $quertString .= $request->q;
        }

        if(isset($request->brand)) {
            $quertString .= '&filter=BRAND:'.$request->brand;
        }

        if(isset($request->sortBy)) {
            $quertString .= '&sortBy='.$request->sortBy;
        }

        if(isset($request->direction)) {
            $quertString .= '&direction='.$request->direction;
        }

        $response = (new Client())->get('http://localhost/api/v1/products?q='.$quertString, [
            'headers' => $this->headers
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return view('product.index', compact('response', 'request'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $formatCurrency = str_replace(",",".",str_replace(".","",$request->price));
        $request->merge(['price' => $formatCurrency]);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'brand' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' =>'required|integer',
        ], [
            'name.required' => "É necessário preencher o campo nome.",
            'name.max' => "O campo nome não pode ser maior que 255 caracteres.",
            'name.unique' => "Produto já cadastrado.",
            'brand.required' => "É necessário preencher o campo marca.",
            'brand.max' => "O campo marca não pode ser maior que 255 caracteres.",            
            'price.required' => "É necessário preencher o campo preço.",
            'price.numeric' => "O campo preço tem que ser numérico",
            'quantity.required' => "É necessário preencher o campo quantidade.",
            'quantity.integer' => "O campo quantidade tem que ser um número inteiro",
        ]);

        $response = (new Client())->post('http://localhost/api/v1/products', [
            'headers' => $this->headers, 
            'form_params' => [
                'name' => $request['name'],
                'brand_id' => $request['brand'],
                'price' => $request['price'],
                'quantity' => $request['quantity'],
            ]
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return redirect('produtos')->with('success');
    }

    public function edit($id)
    {
        $response = (new Client())->get('http://localhost/api/v1/products/'.$id, [
            'headers' => $this->headers
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return view('product.edit', compact('response'));
    }

    public function update(Request $request, $id)
    {
        $formatCurrency = str_replace(",",".",str_replace(".","",$request->price));
        $request->merge(['price' => $formatCurrency]);

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'brand' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' =>'required|integer',
        ], [
            'name.required' => "É necessário preencher o campo nome.",
            'name.max' => "O campo nome não pode ser maior que 255 caracteres.",
            'name.unique' => "Produto já cadastrado.",
            'brand.required' => "É necessário preencher o campo marca.",
            'brand.max' => "O campo marca não pode ser maior que 255 caracteres.",            
            'price.required' => "É necessário preencher o campo preço.",
            'price.numeric' => "O campo preço tem que ser numérico",
            'quantity.required' => "É necessário preencher o campo quantidade.",
            'quantity.integer' => "O campo quantidade tem que ser um número inteiro",
        ]);

        $response = (new Client())->put('http://localhost/api/v1/products/'.$id, [
            'headers' => $this->headers, 
            'form_params' => [
                'name' => $request['name'],
                'brand_id' => $request['brand'],
                'price' => $request['price'],
                'quantity' => $request['quantity'],
            ]
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return redirect('produtos')->with('success');
    }


    public function destroy($id)
    {
        $response = (new Client())->delete('http://localhost/api/v1/products/'.$id, [
            'headers' => $this->headers
        ]);

        $response = json_decode((string) $response->getBody(), true);

        return redirect('produtos')->with('success');
    }
}

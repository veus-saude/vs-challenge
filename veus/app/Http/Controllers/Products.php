<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
	
	private $table = "products";
	
    public function index($q = "", $filter="", $order = "id", $limit = "", $page = 1){
		
		$query = DB::table($this->table);
		
		if(!$q && isset($_GET['q'])) $q = $_GET['q'];
		$filter =(!$filter && isset($_GET['filter'])) ? explode(":", $_GET['filter']) : explode(":", $filter);
		
		if(!$limit && isset($_GET['limit'])) $limit = $_GET['limit'];
		if(isset($_GET['page'])) $page = $_GET['page'];
		
		if(isset($_GET['order'])) $order = $_GET['order'];
		
		if($q) $query->where('name', 'like', sprintf('%%%s%%', $q));
		if(count($filter) == 2) $query->where($filter[0], $filter[1]);		
		
    	if($limit) $query->offset(($page-1)*$limit)->limit($limit);
		
		$query->orderBy($order, "ASC");
		
		return $query->get();
		
    }
	
	public function forbidden() {
		abort(403, 'Unauthorized action.');
	}
	
	public function store(Request $request) {
     	$product = new Product;
 
     	$product->name = $request->input('name');
	 	$product->brand = $request->input('brand');
	 	$product->price = $request->input('price');
	 	$product->amount = $request->input('amount');
		
     	$product->save();
 
     	return 'Produto criado com sucesso. #' . $product->id;
	}
	
	public function show($id) {
		return Product::find($id);
	}
	
	public function update(Request $request, $id) {
		$product = Product::find($id);
	 
		$product->name = $request->input('name');
	 	$product->brand = $request->input('brand');
	 	$product->price = $request->input('price');
	 	$product->amount = $request->input('amount');
		$product->save();
	 
		 return "Produto #" . $product->id . " editado com sucesso.";
	}
	
	public function destroy(Request $request, $id) {
 
		$product = Product::find($id);
		$product->delete();
	 
		return "Produto #" . $id. " excluído com sucesso.";
	}
	
	
}

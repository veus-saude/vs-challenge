<?php
namespace Api\V1\Controllers;

use Api\V1\Models\Product;

class ProductsController extends BaseController
{
	protected $product;

	public function __construct()
	{
		parent::__construct();
		
		$this->product = new Product;
	}

	public function index()
	{
		$products = $this->product
		->search($this->request->get('q'))
		->sort($this->request->get('sort'), $this->request->get('sort_order', 'asc'))
		->when(strstr($this->request->get('filter'), ':'), function($query) {
			list($filterRelation, $filterValue) = explode(':', $this->request->get('filter'));
			
			$query->whereHas($filterRelation, function($query) use($filterValue) {
				return $query->where('name', $filterValue);
			});
		})
		->paginate()
		->getCollection();
	
		return $this->response->json($products);
	}
}

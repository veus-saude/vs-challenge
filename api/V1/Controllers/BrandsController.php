<?php
namespace Api\V1\Controllers;

use Api\V1\Models\Brand;
use Api\V1\Middlewares\CheckToken;

class BrandsController extends BaseController
{
	protected $brand;

	public function __construct()
	{
		(new CheckToken());
	
		parent::__construct();
		
		$this->brand = new Brand;
	}

	public function index()
	{
		$brands = $this->brand
		->search($this->request->get('q'))
		->sort($this->request->get('sort'), $this->request->get('sort_order', 'asc'))
		->paginate()
		->getCollection();
		
		return $this->response->json($brands);
	}
}

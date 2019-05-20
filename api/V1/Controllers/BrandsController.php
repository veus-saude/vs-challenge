<?php
namespace Api\V1\Controllers;

use Api\V1\Models\Brand;

class BrandsController extends BaseController
{
	protected $brand;

	public function __construct()
	{
		parent::__construct();
		
		$this->brand = new Brand;
	}

	public function index()
	{
		$brands = $this->brand->search($this->request->get('q'))->sort($this->request->get('sort'), $this->request->get('sort_order'))->paginate()->getCollection();
		
		return $this->response->json($brands);
	}
}

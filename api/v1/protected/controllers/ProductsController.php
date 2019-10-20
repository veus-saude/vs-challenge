<?php

class ProductsController extends ApiController
{

	protected function get()
	{
		$products = Product::model()->findAll();
		$data = [];
		/** @var Product $product */
		foreach($products as $product) {
			$row = $product->getAttributes();
			$row['brand'] = $product->brand;
			
			$data[] = $row;
		}
		echo CJSON::encode($data);
	}

	protected function post()
	{

	}

	protected function put()
	{

	}

	protected function delete()
	{

	}
	
}

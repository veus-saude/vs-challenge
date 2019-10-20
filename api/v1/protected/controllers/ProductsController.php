<?php

class ProductsController extends ApiController
{

	protected function get()
	{
		$products = Product::model()->findAll();
		echo CJSON::encode($products);
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

<?php

class ProductsController extends ApiController
{

	protected function get()
	{
		$criteria = new CDbCriteria();
		
		if (isset($_GET['q'])) {
			$criteria->compare('name', $_GET['q'], true);
		}
		if (isset($_GET['filter'])) {
			$filters = is_array($_GET['filter']) ? $_GET['filter'] : [$_GET['filter']];
			foreach($filters as $filter) {
				$tokensFilter = explode(':', $filter);

				$attributeName = $tokensFilter[0];
				$filterValue = $tokensFilter[1];

				if ($attributeName == 'brand') {
					$criteria->join = 'JOIN brand ON (brand.id = t.idBrand)';
					$criteria->addCondition('brand.name = :brandName');
					$criteria->params[':brandName'] = $filterValue;
				}
				else {
					$criteria->compare($attributeName, $filterValue);
				}
			}
		}

		$products = Product::model()->findAll($criteria);
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

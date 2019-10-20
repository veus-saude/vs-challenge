<?php

class ProductsController extends ApiController
{

	protected function get()
	{
		$products = Product::model()->findAll($this->getCriteria());
		$data = [];
		/** @var Product $product */
		foreach($products as $product) {
			$row = $product->getAttributes();
			$row['brand'] = $product->brand;

			$data[] = $row;
		}
		
		$this->returnSuccess($data);
	}

	protected function getCriteria() {
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

		return $criteria;
	}

	protected function post()
	{
		if (!isset($_POST['Product'])) {
			$this->returnError('Nenhum atributo do Produto foi recebido');
		}

		$model = new Product();
		$model->setAttributes($_POST['Product']);

		try {
			if ($model->save()) {
				$this->returnSuccess($model->id, 'Produto cadastrado com sucesso!');
			}
			else {
				$this->returnError($model->getErrors());
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao cadastrar produto: ' . $e->getMessage());
		}
	}

	protected function put()
	{
		parse_str(file_get_contents("php://input"), $requestParams);

		if (!isset($requestParams['id'])) {
			$this->returnError('Parâmetro "id" é obrigatório');
		}

		if (!isset($requestParams['Product'])) {
			$this->returnError('Nenhum atributo do Produto foi recebido');
		}

		$model = Product::model()->findByPk($requestParams['id']);
		if (empty($model)) {
			$this->returnError('Não foi encontrado nenhum produto com o id ' . $requestParams['id']);
		}

		$model->setAttributes($requestParams['Product']);

		try {
			if ($model->save()) {
				$this->returnSuccess(null, 'Produto editado com sucesso!');
			}
			else {
				$this->returnError($model->getErrors());
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao editar produto: ' . $e->getMessage());
		}
	}

	protected function delete()
	{
		parse_str(file_get_contents("php://input"), $requestParams);

		if (!isset($requestParams['id'])) {
			$this->returnError('O parâmetro "id" é obrigatório');
		}

		$model = Product::model()->findByPk($requestParams['id']);
		if (empty($model)) {
			$this->returnError('Não foi encontrado nenhum produto com o id ' . $requestParams['id']);
		}

		try {
			if ($model->delete()) {
				$this->returnSuccess('Produto removido com sucesso');
			}
			else {
				$this->returnError('Não foi possível remover o produto');
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao remover produto: ' . $e->getMessage());
		}
	}
	
}

<?php

class BrandsController extends ApiController
{

	protected function get()
	{
		$brands = Brand::model()->findAll($this->getCriteria());
		$this->returnSuccess($brands);
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

				$criteria->compare($attributeName, $filterValue);
			}
		}

		return $criteria;
	}

	protected function post()
	{
		if (!isset($_POST['Brand'])) {
			$this->returnError('Nenhum atributo da Marca foi recebido');
		}

		$model = new Brand();
		$model->setAttributes($_POST['Brand']);

		try {
			if ($model->save()) {
				$this->returnSuccess($model->id, 'Marca cadastrada com sucesso!');
			}
			else {
				$this->returnError($model->getErrors());
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao cadastrar marca: ' . $e->getMessage());
		}
	}

	protected function put()
	{
		parse_str(file_get_contents("php://input"), $requestParams);

		if (!isset($requestParams['id'])) {
			$this->returnError('Parâmetro "id" é obrigatório');
		}

		if (!isset($requestParams['Brand'])) {
			$this->returnError('Nenhum atributo da Marca foi recebido');
		}

		$model = Brand::model()->findByPk($requestParams['id']);
		if (empty($model)) {
			$this->returnError('Não foi encontrada nenhuma marca com o id ' . $requestParams['id']);
		}

		$model->setAttributes($requestParams['Brand']);

		try {
			if ($model->save()) {
				$this->returnSuccess(null, 'Marca editada com sucesso!');
			}
			else {
				$this->returnError($model->getErrors());
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao editar marca: ' . $e->getMessage());
		}
	}

	protected function delete()
	{
		parse_str(file_get_contents("php://input"), $requestParams);

		if (!isset($requestParams['id'])) {
			$this->returnError('O parâmetro "id" é obrigatório');
		}

		$model = Brand::model()->findByPk($requestParams['id']);
		if (empty($model)) {
			$this->returnError('Não foi encontrada nenhuma marca com o id ' . $requestParams['id']);
		}

		try {
			if ($model->delete()) {
				$this->returnSuccess('Marca removida com sucesso');
			}
			else {
				$this->returnError('Não foi possível remover a marca');
			}
		}
		catch(Exception $e) {
			$this->returnError('Erro ao remover marca: ' . $e->getMessage());
		}
	}
	
}

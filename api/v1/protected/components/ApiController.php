<?php

abstract class ApiController extends Controller
{

	public function actionIndex()
	{
		if (!$this->isValidToken()) {
			$this->returnError('Acesso não permitido: Seu token é inválido.');
		}

		if (Yii::app()->request->getRequestType() == 'GET') {
			$this->get();
		} else if (Yii::app()->request->isPostRequest) {
			$this->post();
		} else if (Yii::app()->request->isPutRequest) {
			$this->put();
		} else if (Yii::app()->request->isDeleteRequest) {
			$this->delete();
		} else {
			$this->returnError('Requisições do tipo ' . Yii::app()->request->getRequestType() . ' não são suportadas');
		}
	}

	protected function isValidToken()
	{
		return true;
	}

	protected function returnError($messages, $code = 400)
	{
		$messages = is_array($messages) ? $messages : [$messages];

		echo CJSON::encode([
			'status' => 'error',
			'code' => $code,
			'messages' => $messages,
		]);
		Yii::app()->end();
	}

	protected function returnSuccess($messages, $result, $code = 200)
	{
		$messages = is_array($messages) ? $messages : [$messages];

		echo CJSON::encode([
			'status' => 'ok',
			'code' => $code,
			'messages' => $messages,
			'result' => $result,
		]);
		Yii::app()->end();
	}

	protected abstract function get();

	protected abstract function post();

	protected abstract function put();

	protected abstract function delete();
}

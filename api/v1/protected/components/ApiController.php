<?php

use Firebase\JWT\ExpiredException;

abstract class ApiController extends Controller
{

	protected $requireToken = true;

	public function actionIndex()
	{
		if ($this->requireToken) {
			$this->validateToken();
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

	/** 
	 * Get header Authorization
	 * */
	protected function getAuthorizationHeader() {
		$authorizationHeader = null;
		if (isset($_SERVER['Authorization'])) {
			$authorizationHeader = trim($_SERVER["Authorization"]);
		}
		else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$authorizationHeader = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$authorizationHeader = trim($requestHeaders['Authorization']);
			}
		}
		return $authorizationHeader;
	}

	/**
	* get access token from header
	* */
	protected function getBearerToken() {
		$authorizationHeader = $this->getAuthorizationHeader();
		// HEADER: Get the access token from the header
		if (!empty($authorizationHeader)) {
			if (preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}

	protected function validateToken()
	{
		$jwt = $this->getBearerToken();
		if (!empty($jwt)) {
			try {
				Yii::app()->session['token'] = Yii::app()->JWT->decode($jwt);
			}
			catch (ExpiredException $e) {
				$this->returnError('Token expirado');
			}
			catch (Exception $e) {
				$this->returnError('Token inválido');
			}
		}
		else {
			$this->returnError('Token não recebido');
		}
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

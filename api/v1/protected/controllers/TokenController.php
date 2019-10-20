<?php

class TokenController extends ApiController
{

	protected $requireToken = false;

	protected function get()
	{
		
	}

	protected function post()
	{
		if (isset($_POST['login'], $_POST['password']) && $this->isValidCredential($_POST['login'], $_POST['password'])) {
			$token = Yii::app()->JWT->encode([
				'exp'=>time() + 5,
				'iss'=>'http://localhost',
				'data'=>[
					'login'=>$_POST['login'],
				],
			]);

			$this->returnSuccess(['token'=>$token]);
		}
		
		$this->returnError('Credenciais inválidas');
	}

	protected function isValidCredential($login, $password)
	{
		return $login == 'admin' && $password == 'admin';
	}

	protected function put()
	{

	}

	protected function delete()
	{

	}
}
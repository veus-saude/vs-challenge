<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;
use App\Models\Usuario;
use \Firebase\JWT\JWT;


// Rotas para geração de token
$app->post('/api/token', function(Request $request, Response $response){

	$dados = $request->getParsedBody();

	$email = $dados['email'];
	$senha = $dados['senha'];
	//$email = 'renanq@gmail.com';
	//$senha = '240625';

	$usuario = Usuario::where('email', '=', $email)->first();

	if( !is_null($usuario) && (md5($senha) === $usuario->senha ) ){

		//gerar token
		$secretKey   = $this->get('settings')['secretKey'];
		$chaveAcesso = JWT::encode($usuario, $secretKey);

		return $response->withJson([
			'chave' => $chaveAcesso
		]);

	}

	return $response->withJson([
		'status' => 'erro'
	]);

});

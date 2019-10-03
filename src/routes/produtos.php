<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Rotas para produtos
$app->group('/api/v1', function(){

	// Lista produtos
	$this->get('/produtos/lista', function($request, $response){

		if (isset($_GET['nome'])){
			$nome = $_GET['nome'];
			if (isset($_GET['marca'])){
				$marca = $_GET['marca'];
				$produtos = Produto::where([
											['nome','like',$nome.'%'], 
											['marca','=',$marca]
										])->orderBy('nome', 'asc')->get();
				return $response->withJson( $produtos );
			}else{
				$produtos = Produto::where('nome','like',$nome.'%')->orderBy('nome', 'asc')->get();
				return $response->withJson( $produtos );
			}

		}else 
			if (isset($_GET['marca'])){	
				$marca = $_GET['marca'];
				$produtos = Produto::where('marca','=',$marca)->orderBy('marca', 'asc')->get();
				return $response->withJson( $produtos );
			}
			else{
				if(isset($_GET['ordem'])){
					$produtos = Produto::orderBy('nome','desc')->get();
					return $response->withJson( $produtos );
				}
				else{
					if (isset($_GET['pag'])){
						$produtos = Produto::orderBy('nome','asc')->get();
						$t = count($produtos);
						$i = $_GET['pag'];
						$p = $t / $i; 
						$n = 0;
						$pagina = array();
						for ($c = 0; $c < $p; $c++){
							$pagina[$c] = Produto::skip($n)->take($i)->get();
							$n = $n + $i;
						}
						return $response->withJson( $pagina );
					}
					else{
						$produtos = Produto::orderBy('nome','asc')->get();
						return $response->withJson( $produtos );
					}
				}
			}
	

	});

	// Adiciona um produto
	$this->post('/produtos/adiciona', function($request, $response){
		
		$dados = $request->getParsedBody();

		//Validar

		$produto = Produto::create( $dados );
		return $response->withJson( $produto );

	});

	// Recupera produto para um determinado ID
	$this->get('/produtos/lista/{id}', function($request, $response, $args){
		
		$produto = Produto::findOrFail( $args['id'] );
		return $response->withJson( $produto );

	});

	// Atualiza produto para um determinado ID
	$this->put('/produtos/atualiza/{id}', function($request, $response, $args){
		error_reporting( E_ALL ^E_NOTICE );
		$dados = $request->getParsedBody();
		if(!is_null($dados)){
			$produto = Produto::findOrFail( $args['id'] );
			$dados['nome'] ? $nome = $dados['nome'] : $nome = $produto->nome;
			$dados['marca'] ? $marca = $dados['marca'] : $marca = $produto->marca;
			$dados['preco'] ? $preco = $dados['preco'] : $preco = $produto->preco;
			$dados['quantidade'] ? $quantidade = $dados['quantidade'] : $quantidade = $produto->quantidade;
			$produto->update( $dados );
			return $response->withJson( $produto );
		}
		
	});

	// Remove produto para um determinado ID
	$this->get('/produtos/remove/{id}', function($request, $response, $args){

		$produto = Produto::findOrFail( $args['id'] );
		$produto->delete();
		return $response->withJson( $produto );

	});


});

<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$dbService = new Illuminate\Database\Capsule\Manager;
$dbService->addConnection(require('config/database.php'));
$dbService->bootEloquent();

list($version, $path) = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') . '/');

if($version) {
	$routePath = 'routes/' . $version . '.php';
	
	if(file_exists($routePath)) {
		require $routePath;
	} else {
		echo (new Api\Helpers\Response(404))->plain('Versão não encontrada');
	}
} else {
	echo (new Api\Helpers\Response(404))->plain('Versão não informada');
}

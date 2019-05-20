<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager;
use Api\Helpers\{Response, URL};

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

$dbService = new Manager;
$dbService->addConnection(require('config/database.php'));
$dbService->bootEloquent();

list($version, $path) = URL::getSegments();

if($version) {
	$routePath = 'routes/' . $version . '.php';
	
	if(file_exists($routePath)) {
		require $routePath;
	} else {
		echo (new Response(404))->plain('Versão não encontrada');
	}
} else {
	echo (new Response(404))->plain('Versão não informada');
}

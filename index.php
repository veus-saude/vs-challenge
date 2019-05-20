<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$dbService = new Illuminate\Database\Capsule\Manager;
$dbService->addConnection(require('config/database.php'));
$dbService->bootEloquent();

list($version, $path) = explode('/', ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

require 'routes/' . $version . '.php';

<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once dirname(__DIR__) . '/models/Product.php';
include_once dirname(__DIR__) . '/models/Auth.php';
include_once '../jwt/JWT.php';
use \Firebase\JWT\JWT;

$database = new Database();
$db = $database->connect();
$product = new Product($db);
$product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

if(JWT::decode($data->token, '1234567', array('HS256'))) {
    if($product->delete()) {
        echo json_encode(array('message' => 'O registro de produto foi apagado.'));
    }
    else {
        http_response_code(400);
        echo json_encode(array('message' => 'O registro de produto não foi apagado.'));
    }
}
else {
    die(http_response_code(400)); 
}


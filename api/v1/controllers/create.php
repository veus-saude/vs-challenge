<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once dirname(__DIR__) . '/models/Product.php';
include_once dirname(__DIR__) . '/models/Auth.php';
include_once '../jwt/JWT.php';
use \Firebase\JWT\JWT;


$database = new Database();
$db = $database->connect();
$product = new Product($db);

if(JWT::decode($data->token, '1234567', array('HS256'))) {
    $product->product_name = $data->product_name;
    $product->brand = $data->brand;
    $product->price = $data->price;
    $product->amount = $data->amount;

    if($product->create()) {
        http_response_code(201);
        echo json_encode(array('message' => 'O registro de produto foi criado.'));
    }
    else {
        http_response_code(400);
        echo json_encode(array('message' => 'O registro de produto não foi criado.'));
    }
}
else {
    die(http_response_code(400)); 
}


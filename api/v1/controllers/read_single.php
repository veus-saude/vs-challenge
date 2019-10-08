<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once dirname(__DIR__) . '/models/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);
$product->product_id = $_GET['product_id'] ?? die(http_response_code(400));
$product->read_single();

$product_arr = array(
        'product_id' => $product->product_id,
        'product_name' => $product->product_name,
        'brand' => $product->brand,
        'price' => $product->price,
        'amount' => $product->amount
    );

print_r(json_encode($product_arr));
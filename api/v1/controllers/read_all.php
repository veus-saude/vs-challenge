<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once dirname(__DIR__) . '/models/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);

if (isset($_GET['q']) && strlen($_GET['q']) > 0) {
    $product->q = $_GET['q'];
}

if (isset($_GET['filter']) && strlen($_GET['filter']) > 0) {
    $product->filter = $_GET['filter'];
}

if (isset($_GET['order']) && strlen($_GET['order']) > 0) {
    $product->order = $_GET['order'];
}

if (isset($_GET['limit']) && strlen($_GET['limit']) > 0) {
    $product->limit = $_GET['limit'];
}

if (isset($_GET['offset']) && strlen($_GET['offset']) > 0) {
    $product->offset = $_GET['offset'];
}

$result = $product->read();
echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
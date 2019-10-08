<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../jwt/JWT.php';
include_once dirname(__DIR__) . '/models/Auth.php';
use \Firebase\JWT\JWT;

$database = new Database();
$db = $database->connect();
$auth = new Auth($db);
$data = json_decode(file_get_contents('php://input'));

$auth->user_name = $data->user_name;
$auth->user_password = $data->password;

if($auth->authenticate()) {
    $token = [
        "id" => $auth->user_id,
        "name" => $auth->user_name,
        "pwd" => $auth->user_password
    ];

    $jwt = JWT::encode($token, '1234567');

    echo json_encode(array('token' => $jwt));
}
else {
    echo json_encode(array('message' => 'Usuário não encontrado ou senha incorreta.'));
}
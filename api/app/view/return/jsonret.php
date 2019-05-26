<?php

switch ($dados['status']) {
    case 1:
        header("HTTP/1.0 200 OK");
        break;

    case 2:
        header("HTTP/1.0 304 Not Modified");
        break;

    case 3:
        header("HTTP/1.0 412 Precondition Failed");
        header("Content-Type: application/json");
        echo json_encode($dados['mensagem']);
        break;

    case 4:
        header("HTTP/1.0 400 Bad Request");
        header("Content-Type: application/json");
        echo json_encode($dados['mensagem']);
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        break;
}
?>
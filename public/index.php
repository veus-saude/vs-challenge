<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

try {
    switch ($request_uri[0]) {
        case '/':
        case '/auth';
            require '../api/v1/controllers/auth.php';
            break;

        case '/api':
        case '/api/v1/':
        case '/api/v1/products':
            require '../api/v1/controllers/read_all.php';
            break;

        case '/api/v1/products/create':
            require '../api/v1/controllers/create.php';
            break;  

        case '/api/v1/products/show':
            require '../api/v1/controllers/read_single.php';
            break;

        case '/api/v1/products/update':
            require '../api/v1/controllers/update.php';
            break;

        case '/api/v1/products/delete':
            require '../api/v1/controllers/delete.php';
            break;

        default:
            header('HTTP/1.0 404 Not Found');
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

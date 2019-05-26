<?php

header("Content-Type: application/json");

$json = json_encode($json_data);

if ($json === false) {

    $json = json_encode(array("jsonError", json_last_error_msg()));

    if ($json === false) {

        $json = '{"jsonError": "unknown"}';
    }

    http_response_code(500);
}

echo $json;
?>
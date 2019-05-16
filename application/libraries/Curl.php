<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Curl {

    function requestApi($data, $function, $key, $method = "GET") {

        $data_string = json_encode($data);

        if ($method == "GET") {
            $curl = curl_init(base_url("api/$function?$data"));
        } elseif ($method == "DELETE") {
            $curl = curl_init(base_url("api/$function/$data"));
        } else {
            $curl = curl_init(base_url("api/$function"));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'Authorization: ' . $key,
            'Url-Request: ' . $_SERVER['HTTP_HOST']
                ]
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data
        // Send the request
        $result = curl_exec($curl);
        
        if (curl_error($curl)) {
            $error_msg = curl_error($curl);
            if (isset($error_msg)) {
                return json_decode($error_msg);
            }
        }
        curl_close($curl);

        return json_decode(utf8_encode($result));
    }

}

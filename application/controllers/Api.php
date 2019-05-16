<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('m_api'));
    }

    public function products($productData = NULL) {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $autorizationDecoded = $this->_getHeaders();

            if ($autorizationDecoded->header == 200) {
                $productId = "";
                $perPage = 500;
                $pageBegin = 1;
                $sortBy = "created_at";
                $sortOrder = "desc";
                if ($_GET) {
                    if (isset($_GET['per_page'])) {
                        $perPage = $_GET['per_page'];
                    }
                    if (isset($_GET['page'])) {
                        $pageBegin = $_GET['page'];
                    }
                    if (isset($_GET['sort_by'])) {
                        $sortBy = $_GET['sort_by'];
                    }
                    if (isset($_GET['sort_order'])) {
                        $sortOrder = $_GET['sort_order'];
                    }
                    if (isset($_GET['product_id'])) {
                        $productId = $_GET['product_id'];
                    }

                    $getProducts = $this->m_api->getProducts($autorizationDecoded->client_id, $pageBegin, $perPage, $sortBy, $sortOrder, $productId);
                    echo json_encode($getProducts);
                } else {
                    $getProducts = $this->m_api->getProducts($autorizationDecoded->client_id, $pageBegin, $perPage, $sortBy, $sortOrder, $productId);
                    echo json_encode($getProducts);
                }
            } else {
                echo json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {

            $body = file_get_contents('php://input');
            if ($this->_isJSON($body)) {
                $bodyDecoded = json_decode($body);

                $autorizationDecoded = $this->_getHeaders();

                if ($autorizationDecoded->header == 200) {
                    $arrayDataUpdate = [];

                    if (isset($bodyDecoded->id_product)) {
                        if (isset($bodyDecoded->product_name)) {
                            $arrayDataUpdate[0]["product_name"] = $bodyDecoded->product_name;
                        }
                        if (isset($bodyDecoded->price)) {
                            $arrayDataUpdate[0]["price"] = $this->convert_lib->currencyToDouble($bodyDecoded->price);
                        }

                        if (!empty($arrayDataUpdate)) {
                            $this->m_global->updateTableMysql("products", $arrayDataUpdate[0], "id_products", $bodyDecoded->id_product);
                            echo json_encode(["header" => 200, "message" => "OK, Update realizado."]);
                        } else {
                            echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                        }
                    } else {
                        echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                    }
                } else {
                    echo json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
                }
            } else {
                echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {

            $autorizationDecoded = $this->_getHeaders();

            if ($autorizationDecoded->header == 200) {

                if ($productData) {
                    $queryStringArray = json_decode(urldecode($productData));
                    if (isset($queryStringArray)) {
                        $this->m_global->deleteTableMysql("products", "id_products", $productData);
                        echo json_encode(["header" => 200, "message" => "OK, Delete realizado com sucesso."]);
                    } else {
                        echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                    }
                } else {
                    echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                }
            } else {
                echo json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
            }
        } else {

            $body = file_get_contents('php://input');

            if ($this->_isJSON($body)) {
                $bodyDecoded = json_decode($body);
                $autorizationDecoded = $this->_getHeaders();

                if ($autorizationDecoded->header == 200) {
                    $arrayDataInsert = [];

                    if (isset($bodyDecoded->product_name)) {
                        $arrayDataInsert[0]["product_name"] = $bodyDecoded->product_name;
                        $arrayDataInsert[0]["client_id"] = $autorizationDecoded->client_id;
                        $arrayDataInsert[0]["created_at"] = date("Y-m-d H:i:s");
                    } else {
                        echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                    }
                    if (isset($bodyDecoded->price)) {
                        $arrayDataInsert[0]["price"] = $bodyDecoded->price;
                    } else {
                        echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                    }

                    if (!empty($arrayDataInsert)) {

                        $this->m_global->insertTableMysql("products", $arrayDataInsert[0]);
                        echo json_encode(["header" => 200, "message" => "OK, Insert realizado."]);
                    } else {
                        echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
                    }
                }
            } else {
                echo json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
            }
        }
    }

    private function _getHeaders() {
        foreach (getallheaders() as $name => $value) {
            if ($name == "Authorization") {
                $apiKey = $value;
            }
            if ($name == "Url-Request") {
                $urlRequest = $value;
            }
        }
        $apiAutorizationJson = json_encode(["api_key" => $apiKey, "http_host" => $urlRequest]);

        if (!empty($apiKey) && strlen($apiKey) > 2) {
            return json_decode($this->_validate_autorization($apiAutorizationJson));
        } else {
            return json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
        }
    }

    private function _validate_autorization($apiKey) {
        if ($this->_isJSON($apiKey)) {
            $bodyDecoded = json_decode($apiKey);

            if ($bodyDecoded && isset($bodyDecoded->api_key) && isset($bodyDecoded->http_host)) {
                $clientKeyArray = $this->m_api->getClientKey($bodyDecoded->api_key);

                if ($clientKeyArray) {
                    if ($clientKeyArray->status == 1) {
                        $whereArray = array("client_id" => $clientKeyArray->id_client, "url" => $bodyDecoded->http_host);

                        $dateTimeCreated = date("Y-m-d H:i:s");
                        $dateTimeExpires = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($dateTimeCreated)));

                        $apiAutorizationArray = $this->_checkApiAutorization($whereArray);

                        if ($apiAutorizationArray) {
                            if ($dateTimeCreated > $apiAutorizationArray[0]->expires_at) {
                                $whereArray = ["header" => 200, "created_at" => $dateTimeCreated, "expires_at" => $dateTimeExpires];
                                $this->m_global->updateTableMysql("api_authorization", $whereArray, "client_id", $clientKeyArray->id_client);

                                $response = json_encode(["header" => 200, "message" => "OK, Sessão válida.", "client_id" => $clientKeyArray->id_client]);
                            } else {
                                $response = json_encode(["header" => 200, "message" => "OK, Sessão válida.", "client_id" => $clientKeyArray->id_client]);
                            }
                        } else {
                            $dataInsert = ["client_id" => $clientKeyArray->id_client, "url" => $bodyDecoded->http_host, "header" => 200, "created_at" => $dateTimeCreated, "expires_at" => $dateTimeExpires];
                            $this->m_global->insertTableMysql("api_authorization", $dataInsert);

                            $response = json_encode(["header" => 200, "message" => "OK, Sessão válida.", "client_id" => $clientKeyArray->id_client]);
                        }
                    } else {
                        $response = json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
                    }
                } else {
                    $response = json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
                }
            } else {
                $response = json_encode(["header" => 400, "message" => "Bad Request, Sessão inválida."]);
            }
        } else {
            $response = json_encode(["header" => 406, "message" => "Not Acceptable, Suportado apenas o formato JSON."]);
        }

        return $response;
    }

    private function _checkApiAutorization($whereArray) {
        /* $whereArray = array("client_id" => $clientKeyArray->id_client, "url" => $bodyDecoded->http_host); */

        $apiAutorizationArray = $this->m_global->getQueryAllRowsWhere("api_authorization", $whereArray);
        return $apiAutorizationArray ? $apiAutorizationArray : false;
    }

    private function _isJSON($string) {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

}

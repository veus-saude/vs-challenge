<?php

namespace app\model;

use app\config\database;

class productsModel {

    private $conn;

    public function __construct() {
        $this->conn = new database();
    }

    public function create($produto) {

        $query = "INSERT INTO product (
                    name,
                    brand,
                    value,
                    quantity
                ) values (
                    '" . $produto['name'] . "',
                    '" . $produto['brand'] . "',
                    '" . str_replace('#', '.', str_replace('.', ',', str_replace(',', '#', str_replace('R$ ', '', $produto['value'])))) . "',
                    '" . $produto['quantity'] . "'
                )";

        $prepare = $this->conn->prepare($query);

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function read($id = null, $search = null, $filter = null, $page = null, $limit = null, $order = null) {
        $filtro = [];
        $where = '';
        if (!is_null($page) && !is_null($limit)) {
            if ($page <= 1) {
                $offset = 0;
            } else if ($page > 1) {
                $offset = $limit * ($page - 1);
            }
            $limite = "LIMIT " . $offset . ", " . $limit . " ";
        }
        
        if (!is_null($limit) && is_null($page)) {
            $limite = "LIMIT " . $limit . " ";
        } else if (is_null($limit) && is_null($page)) {
            $limite = "LIMIT 100";
        }
        
        if (!is_null($search)) {
            $filtro[] = "(  
                        LOWER(name) LIKE '%" . strtolower(trim($search)) . "%'
                        OR LOWER(brand) LIKE '%" . strtolower(trim($search)) . "%'
                        OR id_product = '" . $search . "'
                    )";
        }
        
        if (!is_null($filter)) {
            $fields = explode(':', $filter);
            $filtro[] = $fields[0] . " = '" . $fields[1] . "' ";
        }
        
        if (!is_null($id) && !empty($id)) {
            $filtro[] = 'id_product = ' . $id;
        }
        
        if (count($filtro) > 0) {
            $where = 'AND ' . implode(' AND ', $filtro);
        }
        
        if (!is_null($order)) {
            $ordem = "ORDER BY " . $order . " ";
        } else {
            $ordem = "ORDER BY id_product DESC ";
        }

        $query = "SELECT
                    id_product,
                    name,
                    brand,
                    REPLACE(REPLACE(REPLACE(value,',','#'),'.',','),'#','.') AS value,
                    quantity,
                    created_at
                FROM
                    product
                WHERE
                    status = 1
                    " . $where . "
                " . $ordem . "
                " . $limite . "
                ;";
        
        return $this->conn->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($produto, $id) {

        $query = "UPDATE product 
                SET 
                    name = '" . $produto['name'] . "',
                    brand = '" . $produto['brand'] . "',
                    value = '" . str_replace('#', '.', str_replace('.', ',', str_replace(',', '#', str_replace('R$ ', '', $produto['value'])))) . "',
                    quantity = '" . $produto['quantity'] . "',
                    updated_at = NOW()
                WHERE 
                    id_product = " . $id;

        $prepare = $this->conn->prepare($query);

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function delete($id) {

        $query = 'UPDATE product 
                SET 
                    status = 0,
                    updated_at = NOW() 
                WHERE 
                    id_product = ' . $id;

        $prepare = $this->conn->prepare($query);

        $prepare->execute();

        return $prepare->rowCount();
    }
    
}

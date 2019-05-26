<?php

namespace app\model;

use app\config\database;

class createtableModel {

    private $conn;

    public function __construct() {
        $this->conn = new database();
    }

    public function create() {

        $query = "CREATE TABLE product (
                    id_product int(11) NOT NULL AUTO_INCREMENT,
                    name varchar(60) COLLATE utf8_bin NOT NULL,
                    brand varchar(60) COLLATE utf8_bin NOT NULL,
                    value varchar(20) COLLATE utf8_bin DEFAULT NULL,
                    quantity int(4) NOT NULL DEFAULT '1',
                    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at datetime DEFAULT NULL,
                    status int(1) NOT NULL DEFAULT '1',
                    PRIMARY KEY (id_product)
                ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";

        return $this->conn->query($query)->fetch();
    }

    public function populate() {

        $query = "INSERT INTO `product` VALUES (1,'Seringa','BUNZL','2.50','10',NOW(),NULL,1),(2,'Luva','BUNZL','3.75','100',NOW(),NULL,1),(3,'Estetoscópio','Littmann','649.90','4',NOW(),NULL,1),(4,'Oxímetro de Dedo Portátil','Bioland','138.27','25',NOW(),NULL,1);";

        return $this->conn->query($query)->fetch();
    }
    
}

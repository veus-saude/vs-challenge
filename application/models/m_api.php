<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_Api extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getClientKey($clientKey) {
        $this->db->select('*');
        $this->db->from('client_keys AS k');
        $this->db->join('clients AS c', 'c.id_clients = k.id_client');
        $this->db->where(array('k.key' => $clientKey));
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result()[0];
        }
    }
    
    public function getProducts($clientId, $pageBegin, $perPage, $sortBy, $sortOrder, $productId = "") {
        $whereArray = ["client_id" => $clientId];
        if(!empty($productId)){
            $whereArray = ["id_products" => $productId, "client_id" => $clientId];
        }
        
        $begin = ($pageBegin - 1) * $perPage;
        $limit = $pageBegin * $perPage;
        
        $this->db->select('*');
        $this->db->from('products AS p');
        $this->db->where($whereArray);
        $this->db->order_by("$sortBy $sortOrder");
        $this->db->limit($limit, $begin);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();
        }
    }
    
}

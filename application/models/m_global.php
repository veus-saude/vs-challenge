<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_Global extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getQuery($table, $whereFlag, $valueFlag) {
        $where = array($whereFlag => $valueFlag);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            $result = $client->result();
            return $result[0];
        }
    }
    
    public function getQueryAllRows($table, $whereFlag, $valueFlag) {
        $where = array($whereFlag => $valueFlag);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            return $client->result();
        }
    }
    
    public function getQueryAll($table) {
        $this->db->select('*');
        $this->db->from($table);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            return $client->result();
        }
    }

    public function updateTableMysql($table, $arrayData, $columnWhere, $valueWhere) {
        /* $arrayData = array( 'title' => 'My title', 'name'  => 'My Name', 'date'  => 'My date' ); */ 
        $this->db->where($columnWhere, $valueWhere);
        $this->db->update($table, $arrayData);
        return ($this->db->affected_rows() >= 1) ? true : false;
    }

    public function deleteTableMysql($table, $whereColumn ,$whereData) {
        $this->db->delete($table, array($whereColumn => $whereData)); 
        return ($this->db->affected_rows() == 1) ? true : false;
    }
    
    public function insertTableMysql($table, $arrayData) {
        $this->db->insert($table, $arrayData);
        return ($this->db->affected_rows() == 1) ? true : false;
    }

    public function getLastQuery($table, $colunOrder) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by("$colunOrder desc");
        $this->db->limit(1);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            $result = $client->result();
            return $result[0];
        }
    }
    
    public function getLastQueryWhere($table, $whereFlag, $valueFlag, $colunOrder) {
        $where = array($whereFlag => $valueFlag);
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by("$colunOrder desc");
        $this->db->limit(1);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            $result = $client->result();
            return $result[0];
        }
    }
    
     public function getQueryAllRowsWhere($table, $whereArray) {
       /* $whereArray = array($whereFlag => $valueFlag, $whereFlag2 => $valueFlag2); */
         
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($whereArray);
        $client = $this->db->get();
        if ($client->num_rows() == 0) {
            return false;
        } else {
            return $client->result();
        }
    }
    
    

}

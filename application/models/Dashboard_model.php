<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getCants(){
        $product = $this->db->get("producto")->num_rows();
        $sale = $this->db->get("venta")->num_rows();
        $client = $this->db->get("cliente")->num_rows();
        $user = $this->db->get("usuario")->num_rows();

        return (object) array(
            "cant_producto" => $product,
            "cant_venta" => $sale,
            "cant_cliente" => $client,
            "cant_usuario" => $user,
        );
    }
    
    public function getSalesYear($year){
        $this->db->select("MONTH(v.fecha) as month, SUM(v.total) as data");
        $this->db->from("venta v");
        $this->db->where("v.fecha >=", $year . "-01-01");
        $this->db->where("v.fecha <=", $year . "-12-31");
        $this->db->group_by("month");
        $this->db->order_by("month");
        $results = $this->db->get();
        return $results->result();
    }

    public function getYears(){
        $this->db->select("YEAR(v.fecha) as year");
        $this->db->from("venta v");
        $this->db->group_by("year");
        $this->db->order_by("year", "desc");
        $results = $this->db->get();
        return $results->result();
    }
    
    public function getSalesWeek(){
        $results = $this->db->query("SELECT DAYOFWEEK(v.fecha) as day, SUM(v.total) as data FROM `venta` WHERE YEARWEEK(v.fecha) = YEARWEEK(CURDATE()) GROUP BY day ORDER BY day");
        return $results->result();
    }

}

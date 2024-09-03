<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product_model extends CI_Model {

    public function save($data){
        $this->db->query('ALTER TABLE producto AUTO_INCREMENT = 1');
        return $this->db->insert("producto", $data);
    }

    public function update($data, $id){
        $this->db->where("id", $id);
        return $this->db->update("producto", $data);
    }

    public function getProduct($id){
        $this->db->select("p.*");
        $this->db->from("producto p");
        $this->db->where("p.id", $id);
        $result = $this->db->get();
        return $result->row();
    }
    
    public function getProducts(){
        $this->db->select("p.*, c.nombre as category, m.nombre as marca");
        $this->db->from("producto p");
        $this->db->join("categoria c", "c.id = p.idCategoria");
        $this->db->join("marca m", "m.id = p.idMarca");
        $results = $this->db->get();
        return $results->result();
    }

    public function delete($id){
        $this->db->where("id", $id);
        $this->db->db_debug = false;
        if ($this->db->delete("producto")) {
            return array("success", "Se eliminó correctamente!");
        } else {
            return array("error", "No se puede eliminar productos que se han vendido!");
        }
    }

    public function getCategorys(){
        $this->db->select("c.id, c.nombre");
        $this->db->from("categoria c");
        $results = $this->db->get();
        return $results->result();
    }

    public function getMarcas(){
        $this->db->select("m.id, m.nombre");
        $this->db->from("marca m");
        $results = $this->db->get();
        return $results->result();
    }

    public function getId(){
        $this->db->select("p.id");
        $this->db->from("producto p");
        $this->db->order_by("p.id", "desc");
        $this->db->limit(1);
        $result = $this->db->get();
        if ($result->row()) {
            return $result->row()->id + 1;
        } else {
            return 0;
        }
    }    
}
?>
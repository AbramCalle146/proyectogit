<?php
defined('BASEPATH') OR exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    public function save($data){
        $this->db->query('ALTER TABLE cliente AUTO_INCREMENT = 1');
        return $this->db->insert("cliente", $data);
    }

    public function update($data, $id){
        $this->db->where("id", $id);
        return $this->db->update("cliente", $data);
    }

    public function getClient($id){
        $this->db->select("c.*");
        $this->db->from("cliente c");
        $this->db->where("c.id", $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function getClients(){
        $this->db->select("c.*");
        $this->db->from("cliente c");
        $this->db->where("c.estado", 1); // Only get active clients
        $results = $this->db->get();
        return $results->result();
    }

    public function delete($id, $idUsuario){
        $data = array(
            'estado' => 0,
            'idUsuario' => $idUsuario
        );
        $this->db->where("id", $id);
        return $this->db->update("cliente", $data);
    }
}
?>
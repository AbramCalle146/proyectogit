<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function save($data){
        // Reinicia el AUTO_INCREMENT solo si es necesario
        $this->db->query('ALTER TABLE categoria AUTO_INCREMENT 1');
        return $this->db->insert("categoria", $data);
    }

    public function update($data, $id){
        // Asegúrate de que el campo idUsuario se actualice con el ID del usuario actual
        $data['idUsuario'] = $this->session->userdata('idUsuario');
        $this->db->where("id", $id);
        return $this->db->update("categoria", $data);
    }

    public function getCategory($id){
        $this->db->select("c.*");
        $this->db->from("categoria c");
        $this->db->where("c.id", $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function getCategorys(){
        $this->db->select("c.*");
        $this->db->from("categoria c");
        $this->db->where("c.estado", 1); // Solo categorías activas
        $results = $this->db->get();
        return $results->result();
    }

    public function delete($id){
        // Actualiza el estado a 0 para realizar la eliminación lógica
        $this->db->where("id", $id);
        $this->db->db_debug = false; // Desactiva la depuración para evitar errores
        $data = array(
            'estado' => 0,
            'idUsuario' => $this->session->userdata('idUsuario')
        );
        if ($this->db->update("categoria", $data)) {
            return array("success", "Se eliminó correctamente!");
        } else {
            return array("error", "No se puede eliminar una categoría que contiene productos!");
        }
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca_model extends CI_Model {

    // Método para guardar una nueva marca
    public function save($data) {
        $this->db->query('ALTER TABLE marca AUTO_INCREMENT 1'); // Reiniciar auto incremento (opcional)
        return $this->db->insert("marca", $data);
    }

    // Método para actualizar una marca existente
    public function update($data, $id) {
        $this->db->where("id", $id);
        return $this->db->update("marca", $data);
    }

    // Método para obtener una marca por ID
    public function getMarca($id) {
        $this->db->select("m.*");
        $this->db->from("marca m");
        $this->db->where("m.id", $id);
        $result = $this->db->get();
        return $result->row();
    }

    // Método para obtener todas las marcas
    public function getMarcas() {
        $this->db->select("m.*");
        $this->db->from("marca m");
        $results = $this->db->get();
        return $results->result();
    }

    // Método para eliminar una marca por ID
    public function delete($id) {
        $this->db->where("id", $id);
        $this->db->db_debug = false; // Desactiva la depuración de la base de datos
        if ($this->db->delete("marca")) {
            return array("success", "Se eliminó correctamente!");
        } else {
            return array("error", "No se puede eliminar una marca que contiene productos!");
        }
    }
}
?>

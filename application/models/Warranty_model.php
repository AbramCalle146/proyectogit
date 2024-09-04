<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warranty_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Cargar la base de datos
        $this->load->database();
    }

    public function save($data) {
        // Verificar que los datos necesarios estén presentes
        $required_fields = ['nombre', 'descripcion', 'duracion', 'fechaInicio', 'fechaFin', 'idUsuario'];
        foreach ($required_fields as $field) {
            if (!isset($data[$field])) {
                return array('error' => 'Faltan datos necesarios: ' . $field);
            }
        }

        // Insertar los datos en la base de datos
        $this->db->insert('garantia', $data);
        if ($this->db->affected_rows() > 0) {
            return array('success' => 'Garantía guardada correctamente.');
        } else {
            return array('error' => 'Error al guardar la garantía.');
        }
    }

    public function update($data, $id) {
        // Verificar que el ID exista antes de actualizar
        $this->db->where('id', $id);
        if ($this->db->count_all_results('garantia') === 0) {
            return array('error' => 'No se encontró la garantía con el ID especificado.');
        }

        // Asegurarse de que el campo idUsuario se actualice
        $data['idUsuario'] = $this->session->userdata('idUsuario');
        
        // Actualizar la garantía
        $this->db->where('id', $id);
        if ($this->db->update('garantia', $data)) {
            return array('success' => 'Garantía actualizada correctamente.');
        } else {
            return array('error' => 'Error al actualizar la garantía.');
        }
    }

    public function getWarranty($id) {
        $this->db->select('g.*');
        $this->db->from('garantia g');
        $this->db->where('g.id', $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function getWarranties() {
        $this->db->select('g.*');
        $this->db->from('garantia g');
        $this->db->where('g.estado', 1); // Solo garantías activas
        $results = $this->db->get();
        return $results->result();
    }

    public function delete($id) {
        // Verificar que el ID exista antes de intentar eliminar
        $this->db->where('id', $id);
        if ($this->db->count_all_results('garantia') === 0) {
            return array('error' => 'No se encontró la garantía con el ID especificado.');
        }

        // Realizar eliminación lógica
        $this->db->where('id', $id);
        $data = array(
            'estado' => 0,
            'idUsuario' => $this->session->userdata('idUsuario')
        );
        
        // Actualizar el estado para eliminar lógicamente
        if ($this->db->update('garantia', $data)) {
            return array('success' => 'Garantía eliminada correctamente.');
        } else {
            return array('error' => 'Error al eliminar la garantía.');
        }
    }
}
?>

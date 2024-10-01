<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_model extends CI_Model {

    public function save($data) {
        // Reiniciar el AUTO_INCREMENT de la tabla venta
        $this->db->query('ALTER TABLE venta AUTO_INCREMENT = 1');
        return $this->db->insert("venta", $data);
    }

    public function saveDetail($data) {
        // Reiniciar el AUTO_INCREMENT de la tabla detalle_venta
        $this->db->query('ALTER TABLE detalle_venta AUTO_INCREMENT = 1');
        return $this->db->insert("detalle_venta", $data);
    }

    public function update($data, $id) {
        $this->db->where("id", $id);
        return $this->db->update("venta", $data);
    }

    public function getSale($id) {
        $this->db->select("v.*");
        $this->db->from("venta v");
        $this->db->where("v.id", $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function getSales() {
        $this->db->select("v.*, c.nombre as client, co.nombre as comprobante");
        $this->db->from("venta v");

        $this->db->join("cliente c", "c.id = v.idCliente");
        $this->db->join("comprobante co", "co.id = v.idComprobante");
        $results = $this->db->get();
        return $results->result();
    }

    public function getProducts($name) {
        $this->db->select("p.id, p.nombre as label, p.precio as price, p.stock");
        $this->db->from("producto p");
        $this->db->like("p.nombre", $name);
        $results = $this->db->get();
        return $results->result_array();
    }

    public function getClients() {
        $this->db->select("c.id, c.nombre, c.num_documento");
        $this->db->from("cliente c");
        $results = $this->db->get();
        return $results->result();
    }

    public function getVouchers() {
        $this->db->select("co.nombre");
        $this->db->from("comprobante co");
        $results = $this->db->get();
        return $results->result();
    }

    public function getVoucher($name) {
        $this->db->select("co.id, co.nombre, co.igv");
        $this->db->from("comprobante co");
        $this->db->where("co.nombre", $name);
        $results = $this->db->get();
        return $results->row();
    }

    public function getId() {
        return $this->db->insert_id();
    }
}

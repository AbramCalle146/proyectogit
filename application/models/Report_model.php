<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function getVentasPorFechas($fechaInicio = null, $fechaFin = null) {
        $this->db->select('v.id, v.fecha, c.nombre AS cliente, p.nombre AS producto, SUM(dv.cantidad) AS cantidad_productos, SUM(dv.cantidad * dv.precio) AS total_venta');
        $this->db->from('venta v');
        $this->db->join('detalle_venta dv', 'dv.idVenta = v.id');
        $this->db->join('cliente c', 'c.id = v.idCliente');
        $this->db->join('producto p', 'p.id = dv.idProducto');
    
        // Si no se ingresan fechas, no aplicamos el filtro de fechas
        if (!empty($fechaInicio) && !empty($fechaFin)) {
            $this->db->where('v.fecha >=', date('Y-m-d', strtotime($fechaInicio)));
            $this->db->where('v.fecha <=', date('Y-m-d', strtotime($fechaFin)));
        }
    
        $this->db->where('v.estado', 1); // Solo ventas válidas
        $this->db->group_by('v.id, v.fecha, c.nombre, p.nombre');
        $this->db->order_by('v.fecha', 'ASC');
    
        return $this->db->get()->result();
    }
    
    // Obtener productos más vendidos
    public function getProductosMasVendidos() {
        $this->db->select('p.nombre AS producto, SUM(dv.cantidad) AS total_vendido, SUM(dv.cantidad * dv.precio) AS total_bs');
        $this->db->from('detalle_venta dv');
        $this->db->join('producto p', 'p.id = dv.idProducto'); 
        $this->db->group_by('p.id, p.nombre'); // Agrupar correctamente
        $this->db->order_by('total_vendido', 'DESC');
        $this->db->limit(10);

        // Ejecutar consulta
        $query = $this->db->get();
        if (!$query) {
            log_message('error', 'Error en getProductosMasVendidos: ' . $this->db->last_query());
            return []; // Retornar un array vacío en caso de error
        }

        return $query->result(); // Devuelve los productos más vendidos
    }

    public function getClientesFieles() {
        // Seleccionar el nombre del cliente, el total comprado y el número de compras
        $this->db->select('c.nombre AS nombre_cliente, 
                           SUM(dv.cantidad * dv.precio) AS total_comprado, 
                           COUNT(dv.idVenta) AS numero_compras');
        $this->db->from('venta v');
        $this->db->join('detalle_venta dv', 'dv.idVenta = v.id');
        $this->db->join('cliente c', 'c.id = v.idCliente');
        $this->db->where('v.estado', 1); // Solo ventas válidas
        $this->db->group_by('c.id, c.nombre');
        $this->db->order_by('total_comprado', 'DESC');
        $this->db->limit(10);
    
        // Ejecutar consulta
        $query = $this->db->get();
        
        // Comprobar si la consulta se ejecutó correctamente
        if (!$query) {
            log_message('error', 'Error en getClientesFieles: ' . $this->db->last_query());
            return []; // Retornar un array vacío en caso de error
        }
    
        $clientes = $query->result();
    
        // Clasificar a los clientes
        foreach ($clientes as $cliente) {
            // Determinar la categoría del cliente basada en el total comprado
            if ($cliente->total_comprado < 100) {
                $cliente->categoria = 'Regular';
            } elseif ($cliente->total_comprado >= 100 && $cliente->total_comprado <= 500) {
                $cliente->categoria = 'Frecuente';
            } else {
                $cliente->categoria = 'Muy Frecuente';
            }
        }
    
        return $clientes; // Devuelve el resultado
    }
    
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function ventasPorFechas() {
        $fechaInicio = $this->input->get('fecha_inicio');
        $fechaFin = $this->input->get('fecha_fin');
        $data['ventas'] = $this->Report_model->getVentasPorFechas($fechaInicio, $fechaFin);
    
        // Agregar un mensaje si no hay ventas para mostrar
        if (empty($data['ventas'])) {
            $data['mensaje'] = "No se encontraron ventas para el rango de fechas seleccionado. Se mostrarán todas las ventas.";
            $data['ventas'] = $this->Report_model->getVentasPorFechas(); // Obtener todas las ventas
        }
    
        // Cargar vistas
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('report/ventas_por_fechas', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/user');
    }
    

    // Vista de productos más vendidos
    public function productosMasVendidos() {
        $data['productos'] = $this->Report_model->getProductosMasVendidos();

        // Cargar vistas
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('report/productos_mas_vendidos', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/user');
    }

    // Vista de clientes más fieles
    public function clientesFieles() {
        $data['clientes'] = $this->Report_model->getClientesFieles();

        // Cargar vistas
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('report/clientes_fieles', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/user');
    }
}

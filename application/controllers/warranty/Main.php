<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Warranty_model"); // Cargar el modelo de Warranty
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login"); // Redirigir al login si no está autenticado
        }
    }

    // Método para mostrar la vista principal de garantías
    public function index() {
        // Obtener todas las garantías activas
        $data = array("data" => $this->Warranty_model->getWarranties());
    
        // Cargar la vista con los datos de garantías
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('warranty/main', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/warranty');
    }
    
    public function delete($id) {
        // Llamar a la función delete del modelo
        $resp = $this->Warranty_model->delete($id);
    
        // Establecer un mensaje flash y redirigir
        $this->session->set_flashdata($resp[0], $resp[1]);
        redirect(base_url()."garantias");
    }
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Marca_model");
        $this->load->library('form_validation'); // Cargar la biblioteca de validación
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }
    

    public function index() {
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('marca/add');
        $this->load->view('layout/footer');
        $this->load->view('layout/js/marca');
    }

public function save() {
    // Definir las reglas de validación
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[a-zA-Z0-9 ]*$/]');
    $this->form_validation->set_rules('descripcion', 'Descripción', 'required|regex_match[/^[a-zA-Z0-9 ]*$/]');

    // Verificar si las validaciones pasaron
    if ($this->form_validation->run() == FALSE) {
        // Si hay errores de validación, volver a cargar la vista con errores
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('marca/add'); // Pasar los errores a la vista si es necesario
        $this->load->view('layout/footer');
        $this->load->view('layout/js/marca');
    } else {
        // Si la validación es exitosa, guardar los datos
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion')
        );
        $this->Marca_model->save($data);
        $this->session->set_flashdata("success", "Se guardo correctamente!");
        redirect(base_url() . "marcas");
    }
}

}
?>

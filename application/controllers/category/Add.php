<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Category_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {   
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('category/add');
        $this->load->view('layout/footer');
        $this->load->view('layout/js/category');
    }
    
    public function save(){
        $name = $this->input->post("name");
        $description = $this->input->post("description");

        $this->form_validation->set_rules("name", "Nombre", "required|is_unique[categoria.nombre]|regex_match[/^[a-zA-Z0-9\s]+$/]");
        $this->form_validation->set_rules("description", "Descripción", "required|regex_match[/^[a-zA-Z0-9\s]+$/]");
        

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nombre' => $name,
                'descripcion' => $description
            );

            $this->Category_model->save($data);

            $this->session->set_flashdata("success", "Se guardó correctamente!");
            redirect(base_url()."categorias");
        } else {
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('category/add');
            $this->load->view('layout/footer');
            $this->load->view('layout/js/category');
        }
    }
}
?>

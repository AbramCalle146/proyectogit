<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Category_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index($id)
    {   
        $data = $this->Category_model->getCategory($id); 
        
        if ($data) {
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('category/edit', $data);
            $this->load->view('layout/footer');
            $this->load->view('layout/js/category');
        } else {
            show_404(); // Mostrar error 404 si la categoría no se encuentra
        }
    }
    
    public function update($id){
        $name = $this->input->post("name");
        $description = $this->input->post("description");

        $data = $this->Category_model->getCategory($id); 
        $validate_name = "";
        
        if ($name != $data->nombre) { // Cambiado 'name' a 'nombre' para que coincida con la base de datos
            $validate_name = "|is_unique[categoria.nombre]";
        }
        
        $validate_name = "|regex_match[/^[a-zA-Z0-9\s]+$/]";

        $this->form_validation->set_rules("name", "Nombre", "required".$validate_name);
        $this->form_validation->set_rules("description", "Descripción", "required|regex_match[/^[a-zA-Z0-9\s]+$/]");
        

        if ($this->form_validation->run() == TRUE) {
            $user_id = $this->session->userdata('user_id'); // Obtener ID del usuario desde la sesión

            $data = array(
                'nombre' => $name, // Cambiado 'name' a 'nombre'
                'descripcion' => $description, // Cambiado 'description' a 'descripcion'
                'fechaModificacion' => date("Y-m-d H:i:s"), // Ajustar a 'fechaModificacion' según tu base de datos
                'idUsuario' => $user_id // Establecer ID del usuario que hizo la última modificación
            );

            if ($this->Category_model->update($data, $id)) {
                $this->session->set_flashdata("success", "Se modificó correctamente!");
            } else {
                $this->session->set_flashdata("error", "No se pudo modificar la categoría.");
            }
            
            redirect(base_url()."categorias");
        } else {
            $this->index($id);
        }
    }
}
?>

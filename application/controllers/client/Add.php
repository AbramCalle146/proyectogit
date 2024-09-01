<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Client_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {   
        // Definir los tipos de cliente y documento para el formulario
        $data['client_types'] = array(
            'Individual' => 'Individual',
            'Empresa' => 'Empresa',
            'Mayorista' => 'Mayorista',
            'Corporativo' => 'Corporativo'
        );
        
        $data['document_types'] = array(
            'DNI' => 'DNI',
            'Pasaporte' => 'Pasaporte',
            'Cédula' => 'Cédula',
            'RUC' => 'RUC'
        );

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('client/add', $data); // Pasar datos a la vista
        $this->load->view('layout/footer');
        $this->load->view('layout/js/client');
    }
    
    public function save(){
        $this->form_validation->set_rules("name", "Nombre", "required|callback_alpha_space_only");
        $this->form_validation->set_rules("typeClient", "Tipo de cliente", "required");
        $this->form_validation->set_rules("typeDocument", "Tipo de documento", "required");
        $this->form_validation->set_rules("numDocument", "Número de documento", "required|is_unique[cliente.num_documento]");
        $this->form_validation->set_rules("phoneNumber", "Número de teléfono", "required|numeric");
        $this->form_validation->set_rules("address", "Dirección", "required");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nombre' => $this->input->post("name"),
                'tipo_cliente' => $this->input->post("typeClient"),
                'tipo_documento' => $this->input->post("typeDocument"),
                'num_documento' => $this->input->post("numDocument"),
                'direccion' => $this->input->post("address"),
                'telefono' => $this->input->post("phoneNumber"),
                'email' => $this->input->post("email"),
                'idUsuario' => $this->session->userdata("id")
            );

            $this->Client_model->save($data);

            $this->session->set_flashdata("success", "Se guardó correctamente!");
            redirect(base_url() . "clientes");

        } else {
            // Reenviar datos a la vista en caso de error
            $data['client_types'] = array(
                'Individual' => 'Individual',
                'Empresa' => 'Empresa',
                'Mayorista' => 'Mayorista',
                'Corporativo' => 'Corporativo'
            );
            $data['document_types'] = array(
                'DNI' => 'DNI',
                'Pasaporte' => 'Pasaporte',
                'Cédula' => 'Cédula',
                'RUC' => 'RUC'
            );
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('client/add', $data); // Pasar datos a la vista
            $this->load->view('layout/footer');
            $this->load->view('layout/js/client');
        }
    }

    // Custom validation function
    public function alpha_space_only($str){
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $str)){
            $this->form_validation->set_message('alpha_space_only', 'El campo {field} solo puede contener letras y espacios.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
?>

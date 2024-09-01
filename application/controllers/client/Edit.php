<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Client_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index($id)
    {   
        $data['client'] = $this->Client_model->getClient($id); 

        if (!$data['client']) {
            show_404(); // Mostrar una página 404 si el cliente no se encuentra
            return;
        }

        // Configurar los tipos de cliente
        $data['client_types'] = array(
            'Individual' => 'Individual',
            'Empresa' => 'Empresa',
            'Mayorista' => 'Mayorista',
            'Corporativo' => 'Corporativo'
        );

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('client/edit', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/client');
    }
    
    public function update($id)
    {
        $name = $this->input->post("name");
        $typeClient = $this->input->post("typeClient");
        $typeDocument = $this->input->post("typeDocument");
        $numDocument = $this->input->post("numDocument");
        $phoneNumber = $this->input->post("phoneNumber");
        $address = $this->input->post("address");
        $email = $this->input->post("email");
        $idUsuario = $this->session->userdata("id");

        $this->form_validation->set_rules("name", "Nombre", "required|callback_alpha_space_only");
        $this->form_validation->set_rules("typeClient", "Tipo de cliente", "required");
        $this->form_validation->set_rules("typeDocument", "Tipo de documento", "required");
        $this->form_validation->set_rules("numDocument", "Número de documento", "required");
        $this->form_validation->set_rules("phoneNumber", "Número de teléfono", "required|numeric");
        $this->form_validation->set_rules("address", "Dirección", "required");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nombre' => $name,
                'tipo_cliente' => $typeClient,
                'tipo_documento' => $typeDocument,
                'num_documento' => $numDocument,
                'direccion' => $address,
                'telefono' => $phoneNumber,
                'email' => $email,
                'idUsuario' => $idUsuario,
                'updated_at' => date("Y-m-d H:i:s")
            );

            if ($this->Client_model->update($data, $id)) {
                $this->session->set_flashdata("success", "Se modificó correctamente!");
                redirect(base_url()."clientes");
            } else {
                $this->session->set_flashdata("error", "No se pudo modificar el cliente.");
                redirect(base_url()."clientes");
            }
        } else {
            // Reenviar datos a la vista en caso de error
            $data['client_types'] = array(
                'Individual' => 'Individual',
                'Empresa' => 'Empresa',
                'Mayorista' => 'Mayorista',
                'Corporativo' => 'Corporativo'
            );
            $this->index($id);
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

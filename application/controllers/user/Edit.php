<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("User_model");
        if (!$this->session->userdata("login")) {
            redirect('login');
        }
    }

    public function index($id)
    {   
        $data = $this->User_model->getUser($id); 
        $this->session->set_userdata('idUser', $id);

        if ($data) {
            // Cargar vistas
            $data->roles = array(
                'admin' => 'Administrador',
                'empleado' => 'Empleado'
            );
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('user/edit', $data);
            $this->load->view('layout/footer');
            $this->load->view('layout/js/user');
        } else {
            show_404(); // Mostrar una página 404 si el usuario no se encuentra
        }
    }

    public function update($id) {
        // Cargar datos del formulario
        $name = $this->input->post("name");
        $firstSurname = $this->input->post("firstSurname");
        $secondSurname = $this->input->post("secondSurname");
        $email = $this->input->post("email");
        $phoneNumber = $this->input->post("phoneNumber");
        $rolId = $this->input->post("rolId");
        $new_password = $this->input->post("new_password");
        $confirm_password = $this->input->post("confirm_password");
    
        // Obtener datos actuales del usuario
        $current_user = $this->User_model->getUser($id);
        $validate_email = "";
    
        // Validar si el email ha cambiado
        if ($email != $current_user->email) {
            $validate_email = "|is_unique[usuario.email]";
        }
    
        // Configurar reglas de validación
        $this->form_validation->set_rules("name", "Nombre", "required|min_length[3]");
        $this->form_validation->set_rules("firstSurname", "Primer Apellido", "required|min_length[2]");
        $this->form_validation->set_rules("secondSurname", "Segundo Apellido", "required|min_length[2]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email" . $validate_email);
        $this->form_validation->set_rules("phoneNumber", "Número de celular", "required");
        $this->form_validation->set_rules("rolId", "Rol", "required");
    
        // Validar contraseñas si se ingresan
        if ($new_password) {
            $this->form_validation->set_rules("new_password", "Nueva Contraseña", "min_length[6]");
            $this->form_validation->set_rules("confirm_password", "Confirmar Nueva Contraseña", "matches[new_password]");
        }
    
        if ($this->form_validation->run() == TRUE) {
            // Datos a actualizar
            $update_data = array(
                'nombre' => $name,
                'primerApellido' => $firstSurname,
                'segundoApellido' => $secondSurname,
                'email' => $email,
                'telefono' => $phoneNumber,
                'rol' => $rolId,
                'modificado_en' => date("Y-m-d H:i:s")
            );
    
            // Actualizar contraseña si se proporciona una nueva
            if ($new_password) {
                $update_data['contrasena'] = password_hash($new_password, PASSWORD_BCRYPT);
            }
    
            // Actualizar usuario
            if ($this->User_model->update($update_data, $id)) {
                $this->session->set_flashdata("success", "Se modificó correctamente!");
            } else {
                $this->session->set_flashdata("error", "No se pudo modificar el usuario.");
            }
            redirect('usuarios');
        } else {
            // Si la validación falla, vuelve a mostrar la vista de edición con los errores
            $this->index($id);
        }
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("User_model");
        $this->load->library('form_validation');
        $this->load->library('email');
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index(){
        $id = $this->User_model->getId();
        $this->session->set_userdata('idUser', $id);

        // Definir los roles
        $data['roles'] = array(
            'admin' => 'Administrador',
            'empleado' => 'Empleado'
        );

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('user/add', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/user');
    }

    public function save(){
        $this->form_validation->set_rules("name", "Nombre", "required|min_length[3]");
        $this->form_validation->set_rules("firstSurname", "Primer Apellido", "required|min_length[2]");
        $this->form_validation->set_rules("secondSurname", "Segundo Apellido", "required|min_length[2]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[usuario.email]");
        $this->form_validation->set_rules("phoneNumber", "Número de celular", "required");
        $this->form_validation->set_rules("rolId", "Rol", "required|in_list[admin,empleado]");

        if ($this->form_validation->run() == TRUE) {
            // Subir imagen primero
            if (!empty($_FILES['picture']['name'])) {
                $upload_result = $this->upload();

                if ($upload_result['type'] == 'error') {
                    $this->session->set_flashdata('error', $upload_result['message']);
                    redirect(base_url()."nuevo-usuario");
                }
            }

            $name = $this->input->post("name");
            $firstSurname = $this->input->post("firstSurname");
            $secondSurname = $this->input->post("secondSurname");
            $email = $this->input->post("email");
            $phoneNumber = $this->input->post("phoneNumber");
            $rol = $this->input->post("rolId");

            // Generar la contraseña y aplicar hash
            $password = $this->generate_password($name, $firstSurname, $secondSurname, $phoneNumber);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $picture = "img".$this->session->userdata("idUser").".png";

            $data = array(
                'nombre' => $name,
                'primerApellido' => $firstSurname,
                'segundoApellido' => $secondSurname,
                'email' => $email,
                'telefono' => $phoneNumber,
                'contrasena' => $hashed_password,
                'imagen' => $picture,
                'rol' => $rol
            );

            if ($this->User_model->save($data)) {
                // Enviar el email con la contraseña
                $this->send_password_email($email, $password);
                $this->session->set_flashdata("success", "Se guardó correctamente!");
                redirect(base_url()."usuarios");
            } else {
                $this->session->set_flashdata("error", "No se pudo guardar el usuario.");
                redirect(base_url()."nuevo-usuario");
            }
        } else {
            $data['roles'] = array(
                'admin' => 'Administrador',
                'empleado' => 'Empleado'
            );

            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('user/add', $data);
            $this->load->view('layout/footer');
            $this->load->view('layout/js/user');
        }
    }

    public function upload(){
        $id = $this->session->userdata("idUser");
        $picture = "img".$id.".png";

        $config['upload_path'] = './assets/img/user/';
        $config['allowed_types'] = 'jpg|png';
        $config['overwrite'] = true;
        $config['file_name'] = $picture;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('picture')) {
            return array('type' => "error", 'message' => $this->upload->display_errors());
        } else {
            return array('type' => "success", 'message' => "La imagen se subió correctamente");
        }
    }

    private function generate_password($name, $firstSurname, $secondSurname, $phoneNumber) {
        $name_part = substr($name, 0, 2);
        $firstSurname_part = substr($firstSurname, 0, 2);
        $secondSurname_part = substr($secondSurname, 0, 2);
        $phone_part = substr($phoneNumber, -3);
        $random_number = rand(100, 999);
        return $name_part . $firstSurname_part . $secondSurname_part . $phone_part . $random_number;
    }

    private function send_password_email($email, $password) {
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to($email);
        $this->email->subject('Your Account Password');
        $this->email->message('Your password is: ' . $password);

        if ($this->email->send()) {
            log_message('info', 'Password email sent to: ' . $email);
        } else {
            log_message('error', 'Failed to send password email to: ' . $email);
            $error = $this->email->print_debugger(); // Imprime información de depuración
            log_message('error', 'Email debug info: ' . $error);
        }
    }
}

?>

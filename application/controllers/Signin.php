<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Signin_model");
    }

    public function index() {
        if ($this->session->userdata("login")) {
            redirect(base_url()."dashboard");
        } else {
            $this->load->view("signin");
            $this->load->view("layout/js/signin");
        }
    }

    public function signIn() {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $res = $this->Signin_model->signIn($email, md5($password));

        if (!$res) {
            $this->session->set_flashdata("error", "Contraseña o email incorrecto");
            redirect(base_url()."login");
        } else {
            $data = array(
                'id' => $res->id,
                'nombre' => $res->nombre,
                'email' => $res->email,
                'telefono' => $res->telefono,
                'rol' => $res->rol,
                'imagen' => $res->imagen,
                'login' => TRUE
            );

            $this->session->set_userdata($data);
            $this->session->set_flashdata("success", "Bienvenido ".$res->nombre."!");
            redirect(base_url()."dashboard");
        }
    }

    public function updateSession() {
        $idUser = $this->session->userdata("id");
        $this->load->model("Profile_model");
        $res = $this->Profile_model->getUser($idUser);

        $data = array(
            'id' => $res->id,
            'nombre' => $res->nombre,
            'email' => $res->email,
            'telefono' => $res->telefono
        );

        $this->session->set_userdata($data);
        $this->session->set_flashdata("success", "Tu perfil se actualizó correctamente!");
        redirect(base_url()."dashboard");
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url()."login");
    }
}

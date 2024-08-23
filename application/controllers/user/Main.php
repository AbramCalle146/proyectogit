<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("User_model");

        // Verificar si el usuario está autenticado
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "login");
        }
    }

    public function index()
    {       
        // Obtener todos los usuarios
        $data = array("data" => $this->User_model->getUsers()); 

        // Cargar vistas
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('user/main', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/user');
    }
    
    public function delete($id){
        // Eliminar usuario
        $resp = $this->User_model->delete($id);
        // Configurar mensaje flash basado en la respuesta
        $this->session->set_flashdata($resp[0], $resp[1]);
        // Redirigir a la lista de usuarios
        redirect(base_url() . "usuarios");
    }

    public function getData(){
        // Obtener roles
        $resp = $this->User_model->getRols();
        if($resp){
            echo json_encode($resp);
        }
    }
}

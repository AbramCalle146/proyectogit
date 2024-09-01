<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Client_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {       
        $data = array("data" => $this->Client_model->getClients()); 

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('client/main', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/client');
    }
        
    public function delete($id){
        $idUsuario = $this->session->userdata("id");
        $data = array(
            'estado' => 0,
            'idUsuario' => $idUsuario,
            'updated_at' => date("Y-m-d H:i:s")
        );

        $resp = $this->Client_model->delete($id, $data);
        $this->session->set_flashdata($resp[0], $resp[1]);
        redirect(base_url()."clientes");
    }
}
?>

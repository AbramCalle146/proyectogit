<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Category_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {       
        $data = array("data" => $this->Category_model->getCategorys()); 

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('category/main', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/category');
    }

    public function delete($id){
        $resp = $this->Category_model->delete($id);
        $this->session->set_flashdata($resp[0], $resp[1]);
        redirect(base_url()."categorias");
    }
}

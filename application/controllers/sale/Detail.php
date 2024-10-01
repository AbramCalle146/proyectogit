<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Detail_model");
        if (!$this->session->userdata("login")) {
			redirect(base_url()."login");
		}

        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
    }

	public function index($id)
	{       
        $data = array(
            "sale" => $this->Detail_model->getSale($id),
            "data" => $this->Detail_model->getSalesDetail($id)
        ); 
        
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('sale/detail',$data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/detail');
    }
    
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Sale_model");
        if (!$this->session->userdata("login")) {
			redirect(base_url()."login");
        }
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
    }

	public function index()
	{       
        $data = array("data" => $this->Sale_model->getSales()); 

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('sale/main',$data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/sale');
    }
    
    public function getData(){
        $name = $this->input->post("name");
        $resp = $this->Sale_model->getProducts($name);
        echo json_encode($resp);
    }

    public function voucherData(){
        $name = $this->input->post("name");
        $resp = $this->Sale_model->getVoucher($name);
        echo json_encode($resp);
    }

    public function ver(){

		$idSale = $this->Sale_model->getUltimo();
        return $idSale;
		
	}

}

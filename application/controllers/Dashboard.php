<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Dashboard_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "login");
        }
    }

    public function index()
    {   
        $data = array(
            "cants" => $this->Dashboard_model->getCants(),
            "data" => $this->Dashboard_model->getYears()
        );
        
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('dashboard', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/dashboard');
    }

    public function getSalesYear(){
        $year = $this->input->post("year");
        $resp = $this->Dashboard_model->getSalesYear($year);
        echo json_encode($resp);
    }
    
    public function getSalesWeek(){
        $resp = $this->Dashboard_model->getSalesWeek();
        echo json_encode($resp);
    }
}

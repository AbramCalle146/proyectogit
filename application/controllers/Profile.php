<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Profile_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {   
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('profile');
        $this->load->view('layout/footer');
        $this->load->view('layout/js/profile');
    }

    public function save(){

        $idUser = $this->session->userdata("id");
        $name = $this->input->post("nombre");
        $email = $this->input->post("email");
        $phoneNumber = $this->input->post("telefono");
        $validate_email = "";

        if($email != $this->session->userdata("email")){
            $validate_email = "|is_unique[usuario.email]";
        }

        $this->form_validation->set_rules("nombre","Nombre","required|min_length[3]");
        $this->form_validation->set_rules("email","Email","required|valid_email".$validate_email);
        $this->form_validation->set_rules("telefono","Número de celular","required");

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nombre' => $name,
                'email' => $email,
                'telefono' => $phoneNumber,
                'modificado_en' => date('Y-m-d H:i:s')
            );

            $this->Profile_model->save($data, $idUser);
            redirect(base_url()."Signin/UpdateSession");
        } else {
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('profile');
            $this->load->view('layout/footer');
            $this->load->view('layout/js/profile');
        }
    }

    public function upload(){

        $id = $this->session->userdata("id");
        $picture = "img".$id.".png";

        $config['upload_path'] = './assets/img/user';
        $config['allowed_types'] = 'jpg|png';
        $config['overwrite'] = true;
        $config['file_name'] = $picture;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('picture')) {
            $resp = array('type' => "error", 'message' => substr($this->upload->display_errors(), 3, -4));
        } else {
            $this->upload->data();
            $data = array(
                'imagen' => $picture,
                'modificado_en' => date('Y-m-d H:i:s')
            );
            $this->Profile_model->updateImage($data, $id);
            $resp = array('type' => "success", 'message' => "La imagen se subió correctamente");
        }

        echo json_encode($resp);
    }
}
?>

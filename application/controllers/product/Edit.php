<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Product_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }

        // Restricción de rol para editar productos
        if($this->session->userdata("rol") == 'Empleado'){ 
            $this->session->set_flashdata("error", "No tiene permisos para editar productos");
            redirect(base_url()."productos");
        }
    }

    public function index($id)
    {   
        $data = $this->Product_model->getProduct($id); 
        $this->session->set_userdata('idProduct', $id);

        if($data){
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('product/edit', $data);
            $this->load->view('layout/footer');
            $this->load->view('layout/js/product');
        }
    }
    
    public function update($id){

        $barcode = $this->input->post("barcode");
        $name = $this->input->post("name");
        $description = $this->input->post("description");
        $price = $this->input->post("price");
        $stock = $this->input->post("stock");
        $categoryId = $this->input->post("categoryId");
        
        $data = $this->Product_model->getProduct($id); 
        $validate_barcode = "";
        
        if($barcode != $data->codigo_barras){
            $validate_barcode = "|is_unique[producto.codigo_barras]";
        }
        
        $this->form_validation->set_rules("barcode", "Código de barras", "required|max_length[15]|numeric".$validate_barcode);
        $this->form_validation->set_rules("name", "Nombre", "required");
        $this->form_validation->set_rules("description", "Descripción", "required");
        $this->form_validation->set_rules("price", "Precio", "required|decimal"); 
        $this->form_validation->set_rules("stock", "Stock", "required|numeric");

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'codigo_barras' => $barcode,
                'nombre' => $name,
                'descripcion' => $description,
                'precio' => $price,
                'stock' => $stock,
                'idCategoria' => $categoryId,
                'modificado_en' => date("Y-m-d H:i:s") // Cambiado a formato 24 horas
            );

            $this->Product_model->update($data, $id);
            $this->session->set_flashdata("success", "Se modificó correctamente!");
            redirect(base_url()."productos");
            
        } else {
            $this->index($id);
        }
    }
}

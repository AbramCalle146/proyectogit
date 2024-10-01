<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Sale_model");
        $this->load->model("Product_model");
        $this->load->model("Client_model"); // Cargar el modelo de cliente
        if (!$this->session->userdata("login")) {
            redirect(base_url()."login");
        }
    }

    public function index()
    {   
        $data = array(
            "vouchers" => $this->Sale_model->getVouchers(),
            "clients" => $this->Sale_model->getClients()
        ); 

        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('sale/add', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/sale');
    }

    public function save(){
        // Obtener datos del formulario
        $subtotal = $this->input->post("subtotal");
        $igv = $this->input->post("igv");
        $discount = $this->input->post("discount");
        $total = $this->input->post("total");
        $userId = $this->session->userdata("id");

        // Verificar si se proporcionó información de un cliente nuevo
        $newClientName = $this->input->post("newClientName");
        $newClientDocument = $this->input->post("newClientDocument");
        $clientId = $this->input->post("clientId");
        $voucherId = $this->input->post("voucherId"); 

        // Si se proporciona información de un cliente nuevo, registrarlo
        if ($newClientName && $newClientDocument) {
            // Validar campos del nuevo cliente
            $this->form_validation->set_rules("newClientName", "Nombre del cliente", "required|callback_alpha_space_only");
            $this->form_validation->set_rules("newClientDocument", "Número de documento", "required|numeric|is_unique[cliente.num_documento]");

            if ($this->form_validation->run() == TRUE) {
                // Guardar nuevo cliente
                $clientData = array(
                    'nombre' => $newClientName,
                    'num_documento' => $newClientDocument,
                    'telefono' => $this->input->post("newClientPhone"),
                    'direccion' => $this->input->post("newClientAddress"),
                    'email' => $this->input->post("newClientEmail"),
                    'idUsuario' => $userId
                );
                $this->Client_model->save($clientData);

                // Obtener el ID del cliente recién creado
                $clientId = $this->Client_model->getLastInsertedId(); 
            } else {
                $resp = array('type' => "error", 'message' => validation_errors());
                echo json_encode($resp);
                return;
            }
        }

        // Validar venta
        if ($total <= 0) {
            $resp = array('type' => "error", 'message' => "Para realizar la venta agregue productos");
            echo json_encode($resp);
        } else if ($clientId == null) {
            $resp = array('type' => "error", 'message' => "Antes de finalizar la venta seleccione o agregue un cliente");
            echo json_encode($resp);
        } else {
            // Preparar datos de la venta
            $data = array(
                'subtotal' => $subtotal,
                'igv' => $igv,
                'descuento' => $discount,
                'total' => $total,
                'idCliente' => $clientId,
                'idComprobante' => $voucherId,
                'estado' => 1,
                'idUsuario' => $userId
            );

            // Guardar datos de la venta
            $this->Sale_model->save($data);
            $idSale = $this->Sale_model->getId();

            // Guardar detalle de la venta
            $this->detail($idSale);
        }
    }

    private function detail($idSale){
        $ids = $this->input->post("ids");
        $prices = $this->input->post("prices");
        $cants = $this->input->post("cants");
        $discount = $this->input->post("discount");

        for ($i = 0; $i < count($ids); $i++) { 
            $data = array(
                'idVenta' => $idSale,
                'idProducto' => $ids[$i],
                'cantidad' => $cants[$i],
                'precio' => $prices[$i],
                'descuento' => $discount[$i]
            );

            // Guardar detalle
            $this->Sale_model->saveDetail($data);

            // Actualizar stock
            $this->updateStock($ids[$i], $cants[$i]);
        }
    }

    private function updateStock($id, $cant){
        $product = $this->Product_model->getProduct($id);
        if ($product) {
            $data = array(
                'stock' => $product->stock - $cant
            );
            $this->Product_model->update($data, $id);
        }
        $this->session->set_flashdata("success", "Venta exitosa!");
    }

    public function alpha_space_only($str){
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $str)){
            $this->form_validation->set_message('alpha_space_only', 'El campo {field} solo puede contener letras y espacios.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

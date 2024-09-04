<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Warranty_model');
        $this->load->library('form_validation');
        
        // Verificar que el usuario esté autenticado
        if (!$this->session->userdata('login')) {
            redirect(base_url() . 'login');
        }
    }

    public function index() {
        // Cargar las vistas para la página de agregar garantía
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('warranty/add');
        $this->load->view('layout/footer');
        $this->load->view('layout/js/warranty');
    }
    
    public function save() {
        // Obtener el ID del usuario desde la sesión
        $idUsuario = $this->session->userdata('idUsuario');
        if (empty($idUsuario)) {
            $this->session->set_flashdata('error', 'Usuario no autenticado.');
            redirect(base_url() . 'login');
            return;
        }
    
        // Definir las reglas de validación
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[garantia.nombre]|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('duracion', 'Duración', 'required|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('fechaInicio', 'Fecha de Inicio', 'required|callback_valid_date');
        $this->form_validation->set_rules('fechaFin', 'Fecha de Fin', 'required|callback_valid_date');
    
        if ($this->form_validation->run() == TRUE) {
            // Preparar los datos para la inserción
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
                'duracion' => $this->input->post('duracion'),
                'fechaInicio' => $this->input->post('fechaInicio'),
                'fechaFin' => $this->input->post('fechaFin'),
                'estado' => 1, // Activa por defecto
                'fechaCreacion' => date('Y-m-d H:i:s'),
                'fechaModificacion' => NULL, // La fecha de modificación se actualizará automáticamente
                'idUsuario' => $idUsuario // Obtener idUsuario de la sesión
            );
    
            // Insertar los datos en la base de datos usando el modelo
            if ($this->Warranty_model->save($data)) {
                $this->session->set_flashdata('success', 'Garantía guardada correctamente!');
                redirect(base_url() . 'garantias'); // Redirigir a la lista de garantías
            } else {
                $this->session->set_flashdata('error', 'Error al guardar la garantía.');
                redirect(base_url() . 'nuevo-garantia'); // Volver al formulario
            }
        } else {
            // Si hay errores de validación, recargar la vista con errores
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('warranty/add');
            $this->load->view('layout/footer');
            $this->load->view('layout/js/warranty');
        }
    }
    
    // Función de validación personalizada para fechas
    public function valid_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}
?>

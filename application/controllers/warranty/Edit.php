<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Warranty_model');
        $this->load->library('form_validation');
        
        // Verificar que el usuario esté autenticado
        if (!$this->session->userdata('login')) {
            redirect(base_url() . 'login');
        }
    }

    // Mostrar el formulario de edición
    public function index($id) {
        // Obtener los datos de la garantía
        $data['warranty'] = $this->Warranty_model->getWarranty($id); 

        // Verificar si la garantía existe
        if (empty($data['warranty'])) {
            show_404();
        }

        // Cargar las vistas necesarias para el formulario de edición
        $this->load->view('layout/head');
        $this->load->view('layout/sidenav');
        $this->load->view('layout/topnav');
        $this->load->view('warranty/edit', $data);
        $this->load->view('layout/footer');
        $this->load->view('layout/js/warranty');
    }

    // Actualizar los datos de la garantía
    public function update($id) {
        // Definir las reglas de validación
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'required|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('duracion', 'Duración', 'required|regex_match[/^[a-zA-Z0-9\s]+$/]');
        $this->form_validation->set_rules('fechaInicio', 'Fecha de Inicio', 'required|callback_valid_date');
        $this->form_validation->set_rules('fechaFin', 'Fecha de Fin', 'required|callback_valid_date');

        if ($this->form_validation->run() == TRUE) {
            // Preparar los datos para la actualización
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
                'duracion' => $this->input->post('duracion'),
                'fechaInicio' => $this->input->post('fechaInicio'),
                'fechaFin' => $this->input->post('fechaFin'),
                'fechaModificacion' => date('Y-m-d H:i:s'),
                'idUsuario' => $this->session->userdata('idUsuario')
            );

            // Actualizar la garantía en la base de datos
            $update_status = $this->Warranty_model->update($data, $id); 

            if ($update_status) {
                $this->session->set_flashdata('success', 'Garantía actualizada exitosamente.');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la garantía.');
            }

            redirect(base_url() . 'garantias'); 
        } else {
            // Si hay errores de validación, recargar el formulario de edición con los datos y errores
            $data['warranty'] = $this->Warranty_model->getWarranty($id);
            $this->load->view('layout/head');
            $this->load->view('layout/sidenav');
            $this->load->view('layout/topnav');
            $this->load->view('warranty/edit', $data);
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

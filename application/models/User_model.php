<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function save($data){
        // Generate password from user data
        $password = $this->generate_password($data['nombre'], $data['primerApellido']);
        $data['contrasena'] = md5($password);
        
        try {
            $this->db->insert("usuario", $data);
            // Send email with the password
            $this->send_password_email($data['email'], $password);
            return true;
        } catch (Exception $e) {
            log_message('error', 'Error al guardar usuario: ' . $e->getMessage());
            return false;
        }
    }

    public function update($data, $id){
        try {
            $this->db->where("id", $id);
            return $this->db->update("usuario", $data);
        } catch (Exception $e) {
            log_message('error', 'Error al actualizar usuario: ' . $e->getMessage());
            return false;
        }
    }

    public function getUser($id){
        $this->db->select("*");
        $this->db->from("usuario");
        $this->db->where("id", $id);
        $this->db->where("estado", 1); // Asegúrate de que solo se seleccionen usuarios activos
        $result = $this->db->get();
        return $result->row();
    }

    public function getUsers(){
        $this->db->select("*");
        $this->db->from("usuario");
        $this->db->where("estado", 1); // Asegúrate de que solo se seleccionen usuarios activos
        $results = $this->db->get();
        return $results->result();
    }

    public function delete($id){
        try {
            $this->db->where("id", $id);
            $this->db->set('estado', 0); // Establece el campo estado a 0 para indicar que está inactivo
            
            if ($this->db->update("usuario")) {
                return array("success", "Se eliminó correctamente!");
            } else {
                return array("error", "No se pudo actualizar el estado del usuario.");
            }
        } catch (Exception $e) {
            log_message('error', 'Error al eliminar usuario: ' . $e->getMessage());
            return array("error", "No se pudo eliminar el usuario. Error interno.");
        }
    }

    public function getId(){
        $this->db->select("id");
        $this->db->from("usuario");
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $result = $this->db->get();
        if ($result->row()) {
            return $result->row()->id + 1;
        } else {
            return 1; // Asumir que el primer ID es 1
        }
    }

    private function generate_password($nombre, $primerApellido) {
        $nombre_part = substr($nombre, 0, 3);
        $primerApellido_part = substr($primerApellido, -3);
        $random_number = rand(100, 999);
        return $nombre_part . $primerApellido_part . $random_number;
    }

    private function send_password_email($email, $password) {
        $this->load->library('email');

        $this->email->from('your@example.com', 'Your Name');
        $this->email->to($email);
        $this->email->subject('Your Account Password');
        $this->email->message('Your password is: ' . $password);

        if ($this->email->send()) {
            log_message('info', 'Password email sent to: ' . $email);
        } else {
            log_message('error', 'Failed to send password email to: ' . $email);
        }
    }
}
?>

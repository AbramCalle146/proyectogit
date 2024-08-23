<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function signIn($email, $password) {
        $this->db->where("email", $email);
        $this->db->where("contrasena", $password);
        $query = $this->db->get("usuario");

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
}

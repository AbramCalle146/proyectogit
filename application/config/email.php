<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com'; // Servidor SMTP de Gmail con SSL
$config['smtp_port'] = 465; // Puerto para SSL
$config['smtp_user'] = 'abramcalle91@gmail.com'; // Cambiar por tu correo de Gmail
$config['smtp_pass'] = 'Android123'; // Cambiar por tu contraseña de Gmail
$config['mailtype'] = 'html'; // Tipo de correo (puede ser 'text' para texto plano)
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";

?>

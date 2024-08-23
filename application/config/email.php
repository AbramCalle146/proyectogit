<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.yourdomain.com'; // Cambia esto por tu host SMTP
$config['smtp_port'] = 587; // Usa el puerto correcto (587 para TLS, 465 para SSL)
$config['smtp_user'] = 'your_username@yourdomain.com'; // Tu usuario SMTP
$config['smtp_pass'] = 'your_password'; // Tu contraseña SMTP
$config['smtp_crypto'] = 'tls'; // 'ssl' si usas SSL
$config['mailtype']  = 'text'; // O 'html' si envías HTML
$config['charset']   = 'iso-8859-1';
$config['wordwrap']  = TRUE;

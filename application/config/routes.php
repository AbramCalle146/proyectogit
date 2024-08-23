<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';

$route['login'] = 'Signin';
$route['cerrarsesion'] = 'Signin/logout';

$route['perfil'] = 'Profile';
$route['perfil/save'] = 'Profile/save';
$route['perfil/upload'] = 'Profile/upload';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

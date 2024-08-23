<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';

$route['usuarios'] = 'user/Main';
$route['nuevo-usuario'] = 'user/Add';
$route['nuevo-usuario/save'] = 'user/Add/save';
$route['nuevo-usuario/upload'] = 'user/Add/upload';
$route['usuario/(:num)'] = 'user/Edit/index/$1';
$route['usuario/update/(:num)'] = 'user/Edit/update/$1';
$route['usuario/delete/(:num)'] = 'user/Main/delete/$1';

$route['login'] = 'Signin';
$route['cerrarsesion'] = 'Signin/logout';

$route['perfil'] = 'Profile';
$route['perfil/save'] = 'Profile/save';
$route['perfil/upload'] = 'Profile/upload';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

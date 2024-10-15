<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard';

$route['login'] = 'Signin';
$route['cerrarsesion'] = 'Signin/logout';

$route['categorias'] = 'category/Main';
$route['nuevo-categoria'] = 'category/Add';
$route['nuevo-categoria/save'] = 'category/Add/save';
$route['categoria/(:num)'] = 'category/Edit/index/$1';
$route['categoria/update/(:num)'] = 'category/Edit/update/$1';
$route['categoria/delete/(:num)'] = 'category/Main/delete/$1';

$route['marcas'] = 'marca/Main';
$route['nuevo-marca'] = 'marca/Add';
$route['nuevo-marca/save'] = 'marca/Add/save';
$route['marca/(:num)'] = 'marca/Edit/index/$1';
$route['marca/update/(:num)'] = 'marca/Edit/update/$1';
$route['marca/delete/(:num)'] = 'marca/Main/delete/$1';

$route['garantias'] = 'warranty/Main';
$route['nuevo-garantia'] = 'warranty/Add';
$route['nuevo-garantia/save'] = 'warranty/Add/save';
$route['garantia/(:num)'] = 'warranty/Edit/index/$1';
$route['garantia/update/(:num)'] = 'warranty/Edit/update/$1';
$route['garantia/delete/(:num)'] = 'warranty/Main/delete/$1';

$route['productos'] = 'product/Main';
$route['nuevo-producto'] = 'product/Add';
$route['nuevo-producto/save'] = 'product/Add/save';
$route['nuevo-producto/upload'] = 'product/Add/upload';
$route['producto/(:num)'] = 'product/Edit/index/$1';
$route['producto/update/(:num)'] = 'product/Edit/update/$1';
$route['producto/delete/(:num)'] = 'product/Main/delete/$1';

$route['clientes'] = 'client/Main';
$route['nuevo-cliente'] = 'client/Add';
$route['nuevo-cliente/save'] = 'client/Add/save';
$route['cliente/(:num)'] = 'client/Edit/index/$1';
$route['cliente/update/(:num)'] = 'client/Edit/update/$1';
$route['cliente/delete/(:num)'] = 'client/Main/delete/$1';

$route['usuarios'] = 'user/Main';
$route['nuevo-usuario'] = 'user/Add';
$route['nuevo-usuario/save'] = 'user/Add/save';
$route['nuevo-usuario/upload'] = 'user/Add/upload';
$route['usuario/(:num)'] = 'user/Edit/index/$1';
$route['usuario/update/(:num)'] = 'user/Edit/update/$1';
$route['usuario/delete/(:num)'] = 'user/Main/delete/$1';

$route['ventas'] = 'sale/Main';
$route['nuevo-venta'] = 'sale/Add';
$route['nuevo-venta/save'] = 'sale/Add/save';
$route['ventas/(:num)'] = 'sale/Detail/index/$1';

$route['reporte/ventas_por_fechas'] = 'Report/ventasPorFechas';
$route['reporte/productos_mas_vendidos'] = 'Report/productosMasVendidos';
$route['reporte/clientes_fieles'] = 'Report/clientesFieles';

$route['perfil'] = 'Profile';
$route['perfil/save'] = 'Profile/save';
$route['perfil/upload'] = 'Profile/upload';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

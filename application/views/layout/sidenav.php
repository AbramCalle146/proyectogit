<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Android Center</title>
  
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <!-- Sweet Alert 2 CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- App CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css" type="text/css">

  <!-- Custom CSS -->
  <style>
    .navbar-brand-img {
      width: 120px; /* Ajusta el tamaño a tu preferencia */
      height: auto;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }

    .navbar-brand-img:hover {
      transform: scale(1.1);
    }
  </style>
</head>

<body class="signin">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scroll-wrapper scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="<?php echo base_url(); ?>/assets/img/logo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link nav-dashboard" href="<?php echo base_url(); ?>dashboard">
                <i class="ni ni-tv-2 text-default"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-category" href="<?php echo base_url(); ?>categorias">
                <i class="ni ni-tag text-default"></i>
                <span class="nav-link-text">Categorias</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-brand" href="<?php echo base_url(); ?>marcas">
                <i class="fa fa-tags text-default"></i>
                <span class="nav-link-text">Marcas</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-product" href="<?php echo base_url(); ?>productos">
                <i class="ni ni-box-2 text-default"></i>
                <span class="nav-link-text">Productos</span>
              </a>
            </li>
            <!-- Garantías -->
            <li class="nav-item">
              <a class="nav-link nav-guarantee" href="<?php echo base_url(); ?>garantias">
                <i class="fas fa-shield-alt text-default"></i> <!-- Cambiado aquí -->
                <span class="nav-link-text">Garantías</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-client" href="<?php echo base_url(); ?>clientes">
                <i class="ni ni-single-02 text-default"></i>
                <span class="nav-link-text">Clientes</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-user" href="<?php echo base_url(); ?>usuarios">
                <i class="ni ni-circle-08 text-default"></i>
                <span class="nav-link-text">Usuarios</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-sale" href="<?php echo base_url(); ?>ventas">
                <i class="ni ni-cart text-default"></i>
                <span class="nav-link-text">Ventas</span>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
</body>

</html>

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
  <!-- Custom CSS for Login -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" type="text/css">
</head>

<body class="signin">

  <div class="header py-6 py-lg-6 pt-lg-6">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <!-- Aquí puedes incluir una imagen de cabecera si lo deseas -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-gradient border-0 mb-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="title">
              Accede a tu Cuenta
            </div>
            <div class="img-container">
              <img src="<?php echo base_url(); ?>assets/img/img.png" alt="Imagen Descriptiva">
            </div>
            <form role="form" action="<?php echo base_url();?>Signin/signIn" method="post" class="pt-2">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input class="form-control" name="email" placeholder="Email" type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" name="password" placeholder="Password" type="password">
                </div>
              </div>
              <div class="text-center mt-4">
                <a href="<?php echo base_url();?>Signin/forgotPassword" class="btn btn-link">Olvidaste tu contraseña?</a>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Login</button>
              </div>
              <!-- Enlace para olvidar la contraseña -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-scroll-lock/jquery-scrollLock.min.js"></script>
  <!-- Sweet Alert 2 -->
  <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.js"></script>
  <!-- Argon JS -->
  <script src="<?php echo base_url(); ?>assets/js/argon.js?v=1.2.0"></script>

</body>

</html>

<!-- Header -->
<div class="header header-profile pb-6 d-flex align-items-center">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white pt-5">Hola <?php echo $this->session->userdata("nombre"); ?></h1>
        <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Puede ver el progreso que ha logrado con su trabajo y administrar sus proyectos o tareas asignadas.</p>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-4 order-xl-2">
      <div class="card card-profile">
        <img src="<?php echo base_url(); ?>assets/img/theme/banner.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <label class="custom-file-label label-profile" for="fileProfile"> 
                <?php if(file_exists("./assets/img/user/".$this->session->userdata("imagen"))): ?>
                  <img src="<?php echo base_url(); ?>assets/img/user/<?php echo $this->session->userdata("imagen"); ?>" class="rounded-circle">
                <?php else: ?>
                  <img src="<?php echo base_url(); ?>assets/img/user/img.png" class="rounded-circle">
                <?php endif ?>
              </label>
              <input type="file" name="picture" class="custom-file-input" id="fileProfile">
            </div>
          </div>
        </div>
        <div class="card-body pt-4">
          <div class="text-center">
            <h5 class="h3"><?php echo $this->session->userdata("nombre"); ?></h5>
            <h5 class="font-weight-300 pb-5"><?php echo $this->session->userdata("email"); ?></h5>
          </div>
        </div>
      </div>

    </div>
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Edit profile </h3>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url();?>profile/save" method="POST">
            <div class="row pt-2">
              <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Nombres</label>
                    <input type="text" name="nombre" class="form-control <?php echo form_error('nombre') ? 'is-invalid':''?>" placeholder="Tus Nombres y apellidos"  value="<?php echo form_error('nombre') ? set_value('nombre'): $this->session->userdata("nombre"); ?>">
                    <div class="invalid-feedback"><?php echo form_error('nombre'); ?></div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">N° Celular</label>
                  <input type="text" name="telefono" class="form-control <?php echo form_error('telefono') ? 'is-invalid':''?>" placeholder="Tu Número de celular"  value="<?php echo form_error('telefono') ? set_value('telefono'): $this->session->userdata("telefono"); ?>">
                  <div class="invalid-feedback"><?php echo form_error('telefono'); ?></div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input type="text" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid':''?>" placeholder="Tu correo electrónico"  value="<?php echo form_error('email') ? set_value('email'): $this->session->userdata("email"); ?>">
                    <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-success mt-4">Guardar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

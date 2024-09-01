<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Nueva Marca</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo base_url(); ?>marcas" class="btn btn-secondary">Volver</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header" style="background-color: transparent;">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Agregar Marca</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url();?>nuevo-marca/save" method="POST">
            <div class="form-group">
              <label class="form-control-label" style="color: white;" for="input-nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control <?php echo form_error('nombre') ? 'is-invalid':''?>" placeholder="Nombre de la marca" value="<?php echo set_value('nombre'); ?>">
              <div class="invalid-feedback"><?php echo form_error('nombre'); ?></div>
            </div>
            <div class="form-group">
              <label class="form-control-label" style="color: white;" for="input-descripcion">Descripción</label>
              <input type="text" name="descripcion" class="form-control <?php echo form_error('descripcion') ? 'is-invalid':''?>" placeholder="Descripción de la marca" value="<?php echo set_value('descripcion'); ?>">
              <div class="invalid-feedback"><?php echo form_error('descripcion'); ?></div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary mt-4">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

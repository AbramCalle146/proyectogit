<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Nueva Garantía</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>garantias">Garantías</a></li>
                            <li class="breadcrumb-item active">Nueva Garantía</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo base_url(); ?>garantias" class="btn btn-secondary">Volver</a>
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
                            <h3 class="mb-0" style="color: white;">Ingrese los Datos de la Garantía</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="<?php echo base_url(); ?>garantias/save" method="POST">
                        <div class="form-group">
                            <label class="form-control-label" style="color: white;" for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control <?php echo form_error('nombre') ? 'is-invalid':''?>" placeholder="Nombre de la garantía" value="<?php echo set_value('nombre'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('nombre'); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" style="color: white;" for="descripcion">Descripción</label>
                            <textarea rows="4" name="descripcion" id="descripcion" class="form-control <?php echo form_error('descripcion') ? 'is-invalid':''?>" placeholder="Descripción de la garantía"><?php echo set_value('descripcion'); ?></textarea>
                            <div class="invalid-feedback"><?php echo form_error('descripcion'); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" style="color: white;" for="duracion">Duración</label>
                            <input type="text" name="duracion" id="duracion" class="form-control <?php echo form_error('duracion') ? 'is-invalid':''?>" placeholder="Duración de la garantía" value="<?php echo set_value('duracion'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('duracion'); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" style="color: white;" for="fechaInicio">Fecha de Inicio</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control <?php echo form_error('fechaInicio') ? 'is-invalid':''?>" value="<?php echo set_value('fechaInicio'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('fechaInicio'); ?></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" style="color: white;" for="fechaFin">Fecha de Fin</label>
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control <?php echo form_error('fechaFin') ? 'is-invalid':''?>" value="<?php echo set_value('fechaFin'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('fechaFin'); ?></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mt-4">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

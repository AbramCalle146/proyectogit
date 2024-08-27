<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0"><?php echo $nombre; ?></h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>categorias">Categorias</a></li>
                <li class="breadcrumb-item active"><?php echo $nombre; ?></li>
            </ol>
            </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
            <a href="<?php echo base_url(); ?>categorias" class="btn btn-secondary">Volver</a>
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
                        <h3 class="mb-0">Actualice los datos</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url();?>categoria/update/<?php echo $id; ?>" method="POST">
                    <div class="form-group">
                        <label class="form-control-label" style="color: white;" for="input-username">Nombre</label>
                        <input type="text" name="name" class="form-control <?php echo form_error('name') ? 'is-invalid':''?>" placeholder="Nombre de la categoría"  value="<?php echo $nombre; ?>">
                        <div class="invalid-feedback"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" style="color: white;" >Descripción</label>
                        <textarea rows="4" name="description" class="form-control <?php echo form_error('description') ? 'is-invalid':''?>" placeholder="Descripión de la categoría"><?php echo $descripcion; ?></textarea>
                        <div class="invalid-feedback"><?php echo form_error('description'); ?></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mt-4">Guardar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

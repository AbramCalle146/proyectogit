<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Nuevo</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>usuarios">Usuarios</a></li>
                            <li class="breadcrumb-item active">Nuevo</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo base_url(); ?>usuarios" class="btn btn-secondary">Volver</a>
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
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Ingrese datos </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url();?>nuevo-usuario/save" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-control-label">Nombres</label>
                            <input type="text" name="name" class="form-control <?php echo form_error('name') ? 'is-invalid':''?>" placeholder="Nombres del usuario" value="<?php echo set_value('name'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('name'); ?></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Primer Apellido</label>
                            <input type="text" name="firstSurname" class="form-control <?php echo form_error('firstSurname') ? 'is-invalid':''?>" placeholder="Primer apellido del usuario" value="<?php echo set_value('firstSurname'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('firstSurname'); ?></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Segundo Apellido</label>
                            <input type="text" name="secondSurname" class="form-control <?php echo form_error('secondSurname') ? 'is-invalid':''?>" placeholder="Segundo apellido del usuario" value="<?php echo set_value('secondSurname'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('secondSurname'); ?></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="text" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid':''?>" placeholder="Email del usuario" value="<?php echo set_value('email'); ?>">
                            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">N° Celular</label>
                                    <input type="text" name="phoneNumber" class="form-control <?php echo form_error('phoneNumber') ? 'is-invalid':''?>" placeholder="Número de celular del usuario" value="<?php echo set_value('phoneNumber'); ?>">
                                    <div class="invalid-feedback"><?php echo form_error('phoneNumber'); ?></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Rol</label>
                                    <select id="rol" name="rolId" class="form-control <?php echo form_error('rolId') ? 'is-invalid':''?>">
                                        <?php foreach ($roles as $key => $value): ?>
                                            <option value="<?php echo $key; ?>" <?php echo set_select('rolId', $key); ?>><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?php echo form_error('rolId'); ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success mt-4">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Imagen </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="picture" class="custom-file-input" id="customFileLang">
                            <label class="custom-file-label" for="customFileLang"></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <?php if(file_exists("./assets/img/user/img".$this->session->userdata("idUser").".png")): ?>
                                <img id="img-user" src="<?php echo base_url(); ?>assets/img/user/img<?php echo $this->session->userdata("idUser").".png"; ?>" class="img-full rounded">
                            <?php else: ?>
                                <img id="img-user" src="<?php echo base_url(); ?>assets/img/user/img.png" class="img-full rounded">
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

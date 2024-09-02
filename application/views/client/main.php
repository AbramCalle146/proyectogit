<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Clientes</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo base_url(); ?>nuevo-cliente" class="btn btn-secondary">Nuevo</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Lista</h3>
        </div>
        <!-- Light table -->
        <div class="table-responsive">
          <table id="clientTable" class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="sort">N°</th>
                <th scope="col" class="sort">Nombre</th>
                <th scope="col" class="sort">Tp. Cliente</th>
                <th scope="col" class="sort">Tp. Documento</th>
                <th scope="col" class="sort">N°. Documento</th>
                <th scope="col" class="sort">N°. Teléfono</th> 
                <th scope="col" class="sort">Dirección</th>
                <th scope="col" class="sort">Email</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
    <?php if(!empty($data)): ?>
        <?php $number = 1; foreach($data as $value): ?>
            <tr>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $number++; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->name; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->type_client; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->type_document; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->num_document; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->phone_number; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->address; ?></span>
                    </span>
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                        <span class="status"><?php echo $value->email; ?></span>
                    </span>
                </td>
                <td class="text-right">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="<?php echo base_url()."cliente/".$value->id; ?>">Editar</a>
                            <a class="dropdown-item" href="<?php echo base_url()."cliente/delete/".$value->id; ?>">Eliminar</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

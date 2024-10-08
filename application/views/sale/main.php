<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Ventas</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active">Ventas</a></li>
          </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?php echo base_url(); ?>nuevo-venta" class="btn btn-secondary">Nuevo</a>
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
            <div class="card-header border-0" style="background-color: transparent;">
             <h3 class="mb-0" style="font-size: 2rem;">Lista de Ventas</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table id="saleTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort">N°</th>
                    <th scope="col" class="sort">Cliente</th>
                    <th scope="col" class="sort">Fecha</th>
                    <th scope="col" class="sort">Total</th>
                    <th scope="col" class="sort">Comprobante</th>
                    <th scope="col" class="sort"></th>
                  </tr>
                </thead>
                <tbody class="list">

                  <?php if(!empty($data)):?>
                    <?php $number=1; foreach($data as $value):?>
                    <tr>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <span class="status"><?php echo $number++; ?></span>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <span class="status"><?php echo $value->cliente; ?></span>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <span class="status"><?php echo date("Y-m-d", strtotime($value->date));?></span>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <span class="status"><?php echo $value->total; ?></span>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-dot mr-4">
                          <span class="status"><?php echo $value->comprobante; ?></span>
                        </span>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-default" href="<?php echo base_url(); ?>ventas/<?php echo $value->id; ?>">
                          <span class="btn-inner-icon"><i class="ni ni-laptop"></i></span>
                        </a>
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


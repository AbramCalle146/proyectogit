<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Clientes Fieles</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>report">Reportes</a></li>
              <li class="breadcrumb-item active">Clientes Fieles</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a id="print" class="btn btn-secondary text-default">Imprimir</a>
          <a href="<?php echo base_url(); ?>report" class="btn btn-secondary text-default">Volver</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Load the report JavaScript -->
<?php $this->load->view('layout/js/report'); ?>

<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-12 col-auto">
      <div class="card">
        <div class="card-header border-0"style="background-color: transparent;">
          <h5 class="h3"style="font-size: 1.5rem; color: white;">Reporte de Clientes Fieles</h5>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="loyalCustomersTable" class="table align-items-center table-flush">
            <thead class="thead-light">
                  <tr>
                      <th scope="col" class="sort">N°</th>
                      <th scope="col" class="sort">Nombre del Cliente</th>
                      <th scope="col" class="sort">Total Comprado</th>
                      <th scope="col" class="sort">Número de Compras</th>
                      <th scope="col" class="sort">Categoría</th> <!-- Nueva columna para la categoría -->
                  </tr>
              </thead>
              <tbody class="list">
                  <?php if (!empty($clientes)): ?>
                      <?php $number = 1; foreach ($clientes as $cliente): ?>
                          <tr>
                              <td><?php echo $number++; ?></td>
                              <td><?php echo $cliente->nombre_cliente; ?></td>
                              <td><?php echo number_format($cliente->total_comprado, 2); ?></td>
                              <td><?php echo $cliente->numero_compras; ?></td>
                              <td><?php echo $cliente->categoria; ?></td> <!-- Mostrar la categoría -->
                          </tr>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <tr>
                          <td colspan="5">No hay datos disponibles.</td>
                      </tr>
                  <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

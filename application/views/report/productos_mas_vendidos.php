<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Productos Más Vendidos</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>" ><i class="fas fa-home"></i></a>
              </li>
              <li class="breadcrumb-item active ">Productos Más Vendidos</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a id="print" class="btn btn-secondary text-default">Imprimir</a>
          <a href="<?php echo base_url(); ?>report" class="btn btn-secondary">Volver</a>
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
        <div class="card-header border-0" style="background-color: transparent;">
          <h3 class="mb-0" style="font-size: 1.5rem; color: white;">Reporte de Productos Más Vendidos</h3>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="topProductsTable" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="sort">N°</th>
                  <th scope="col" class="sort">Nombre del Producto</th>
                  <th scope="col" class="sort">Cantidad Vendida</th>
                  <th scope="col" class="sort">Total Vendido (Bs)</th>
                </tr>
              </thead>
              <tbody class="list" style="background-color: white;">
                <?php if (!empty($productos)): ?>
                  <?php $number = 1; foreach ($productos as $producto): ?>
                    <tr>
                      <td><?php echo $number++; ?></td>
                      <td><?php echo htmlspecialchars($producto->producto); ?></td>
                      <td><?php echo htmlspecialchars($producto->total_vendido); ?></td>
                      <td><?php echo number_format($producto->total_bs, 2, ',', '.') . ' Bs'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center">No hay datos disponibles.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Styles for printing -->
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/report.css" media="print">

          <!-- Charts Container -->
          <div class="mt-4">
            <div class="card">
              <div class="card-header"style="background-color: transparent;">
                <h5 class="text-light" style="font-size: 1.5rem; color: white;">Gráficos de Ventas</h5>
              </div>
              <div class="card-body">
                <div class="charts-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                  <div class="chart" style="flex: 1; margin: 10px;">
                    <h5 class="text-light">Gráfico de Barras</h5>
                    <canvas id="barChart" height="150" width="300"></canvas>
                  </div>
                  <div class="chart" style="flex: 1; margin: 10px;">
                    <h5 class="text-light">Gráfico de Pastel</h5>
                    <canvas id="pieChart" height="150" width="300"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Load the report JavaScript -->
<?php $this->load->view('layout/js/report'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtiene los datos de PHP
    const productos = <?php echo json_encode($productos); ?>;

    // Prepara los datos para el gráfico de barras
    const labels = productos.map(p => p.producto);
    const dataVendidos = productos.map(p => p.total_vendido);
    const dataTotalBs = productos.map(p => p.total_bs);

    // Configuración del gráfico de barras
    const ctxBar = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cantidad Vendida',
                data: dataVendidos,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Total Vendido (Bs)',
                data: dataTotalBs,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad / Total (Bs)',
                        color: 'white' // Set title color to white
                    },
                    ticks: {
                        maxTicksLimit: 5, // Reduce el número de etiquetas en el eje y
                        color: 'white' // Set tick color to white
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Productos',
                        color: 'white' // Set title color to white
                    },
                    ticks: {
                        color: 'white' // Set tick color to white
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Set legend text color to white
                    }
                }
            }
        }
    });

    // Configuración del gráfico de pastel
    const ctxPie = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Vendido (Bs)',
                data: dataTotalBs,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'white' // Set legend text color to white
                    }
                },
                title: {
                    display: true,
                    text: 'Distribución de Total Vendido (Bs)',
                    color: 'white' // Set title color to white
                }
            }
        }
    });
</script>

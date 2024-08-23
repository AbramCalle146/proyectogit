<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Inicio</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <!-- Productos -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Productos</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo isset($cants->cant_producto) ? $cants->cant_producto : 'No disponible'; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-box-2"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Total</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Ventas -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Ventas</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo isset($cants->cant_venta) ? $cants->cant_venta : 'No disponible'; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Total</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Clientes -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Clientes</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo isset($cants->cant_cliente) ? $cants->cant_cliente : 'No disponible'; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Total</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Usuarios -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo isset($cants->cant_usuario) ? $cants->cant_usuario : 'No disponible'; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-circle-08"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Total</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Garantías -->
                <div class="col-lg-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Garantías</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo isset($cants->cant_garantia) ? $cants->cant_garantia : 'No disponible'; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap">Total</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-8">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">Visión general</h6>
                            <h5 class="h3 text-white mb-0">Ventas del año</h5>
                        </div>
                        <div class="col text-right">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle py-2 px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo date("Y"); ?></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php if (!empty($data)): ?>
                                        <?php foreach ($data as $value): ?>
                                            <a class="dropdown-item"><?php echo $value->year; ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-year" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Funcionamiento</h6>
                            <h5 class="h3 mb-0">Ventas de esta semana</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-week" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

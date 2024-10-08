<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Nueva Venta</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url(); ?>ventas">Ventas</a>
                            </li>
                            <li class="breadcrumb-item active">Nuevo</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a href="<?php echo base_url(); ?>ventas" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header" style="background-color: transparent;">
                    <div class="row align-items-center">
                        <!-- Botón Cliente -->
                        <div class="col-lg-2 col-3">
                            <button class="btn btn-icon btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                                <span class="btn-inner--icon"><i class="ni ni-single-02"></i></span>
                                <span class="btn-inner--text">Cliente</span>
                            </button>
                        </div>

                        <!-- Botón Nuevo Cliente -->
                        <div class="col-lg-2 col-3">
                            <a href="<?php echo base_url(); ?>client/Add" class="btn btn-success">Nuevo Cliente</a>
                        </div>

                        <!-- Texto Recibo -->
                        <div class="col-lg-8 text-right">
                            <h3 class="mb-0" style="font-size: 2rem; margin-left: auto;">Recibo</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="input-group input-group-lg input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-search"></span>
                                    </div>
                                </div>
                                <input id="search-product" name="search-product" type="search" class="form-control" placeholder="Buscar un producto">
                            </div>
                        </div>

                        <!-- Tabla de productos seleccionados -->
                        <div class="col-lg-12 mt-4">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Importe</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list-product">
                                        <!-- Aquí se insertarán los productos dinámicamente -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Campos de subtotal y total -->
                        <div class="col-lg-4 mt-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="color: black;">Sub total</span>
                                    </div>
                                    <input id="subtotal" name="subtotal" type="text" style="color: black;" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="color: black;">Descuento</span>
                                    </div>
                                    <input id="discount" name="discount" style="color: black;" type="text" class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="color: black;">Total</span>
                                    </div>
                                    <input id="total" name="total" style="color: black;" type="text" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Botón de guardar -->
                        <div class="col-lg-12 text-right">
                            <input type="hidden" id="voucherId" name="voucherId" value="1">
                            <input type="hidden" id="clientId" name="clientId">

                            <div class="form-group">
                                <button id="btnSave" class="btn btn-success mt-4">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar cliente -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="saleTable" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombres</th>
                                <th>N° documento</th>
                            </tr>
                        </thead>
                        <tbody class="list-client">
                            <!-- Se insertarán clientes dinámicamente -->
                            <?php if (!empty($clients)): ?>
                                <?php foreach ($clients as $client): ?>
                                    <tr id="<?php echo $client->id; ?>" data-dismiss="modal">
                                        <td><?php echo $client->nombre; ?></td>
                                        <td><?php echo $client->num_documento; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url(); ?>client/Add" class="btn btn-success">Nuevo Cliente</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

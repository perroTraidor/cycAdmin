<main>

<!-- Acá comienza el  título y nav lateral -->
<div class="w-100 d-flex justify-content-center">
        <h5 class="text-center">Compras - Proveedores</h5>
    </div>

<div class="container-lg alto d-flex">
    <div class="container">
    <div class="row">

    <!-- Acá comienza el nav lateral -->
        <div class="col-2">
            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                <div class="btn-group dropend btn" role="group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Proveedores
                    </button>
                    <ul class="dropdown-menu">
                    <li>
                        <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#newProveedorModal">Nuevo proveedor</a>
                    </li>
                    <li>
                    <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#modalBuscarProveedor">Ver proveedor</a>
                    </li>
                    <li><a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#modalEditarProveedor">Editar proveedor</a></li>
                    <li><a class="abtn" type="button" href="/proveedores/list">Lista de proveedores</a></li>
                    <li>
                            <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#resumenModal">Resumen cuenta proveedor</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group dropend btn" role="group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Compras
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#modalCompra">Nueva Compra</a>
                        </li>
                        <li>
                            <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#modalCompra">Consultar Compra</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="btn-group dropend btn" role="group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenes de Pago
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#modalNuevaOp">Nueva Orden de Pago</a></li>
                    <li><a class="dropdown-item" href="#">Consultar Orden de Pago</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Hasta acá el nav lateral -->
    </div>
    </div>    
</div>
<!-- Acá termina el título y nav lateral -->

</main>


<!-- Modal nueva compra-->
<?php include('src/views/compras/modales/modalNuevaCompra.php'); ?>

<!-- Modal fecha resumen de cuenta-->
<?php include('src/views/compras/modales/modalResumen.php'); ?>


<!-- Modal cargar proveedor -->
<?php include('src/views/compras/modales/modalCargarProveedor.php'); ?>


<!-- Modal buscar proveedor -->
<?php include('src/views/compras/modales/modalBuscarProveedor.php'); ?>

<!-- Modal editar proveedor -->
<?php include('src/views/compras/modales/modalEditarProveedor.php'); ?>

<!-- Modal nueva OP -->
<?php include('src/views/compras/modales/modalNuevaOp.php'); ?>
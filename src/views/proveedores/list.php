<main>
<div class="w-100 d-flex justify-content-center" style="padding-bottom: 1em;">
        <h5 class="text-center">Listado de Proveedores</h5>
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
                    <ul class="dropdown-menu" style="padding-right: 10px;">
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


<!-- Acá comienza el contenido -->
        <div class="col-10" style="padding: 0 3em 0 5em;">

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $respuesta['proveedores'] as $p ): ?>
        <tr>
            <td><?php echo $p->getId( ); ?></td>
            <td><?php echo $p->getNombre( ); ?></td>
            <td><?php echo $p->getEmail( ); ?></td>
            <td>
                <a class="btn" data-bs-id="<?php echo $p->getId( ); ?>" type="button" data-bs-toggle="modal" data-bs-target="#resumenModalId">Ver cta</a>
            </td>
        </tr>
        <?php endforeach; ?>
            </td>
        </tr>
    </tbody>
</table> 
        </div>

        
<!-- Modal nueva compra-->
<?php include(VIEWS.'/compras/modales/modalNuevaCompra.php'); ?>

<!-- Modal fecha resumen de cuenta-->
<?php include(VIEWS.'/compras/modales/modalResumen.php'); ?>


<!-- Modal cargar proveedor -->
<?php include(VIEWS.'/compras/modales/modalCargarProveedor.php'); ?>


<!-- Modal buscar proveedor -->
<?php include(VIEWS.'/compras/modales/modalBuscarProveedor.php'); ?>

<!-- Modal resumen por ID -->
<?php include(VIEWS.'/compras/modales/modalResumenId.php'); ?>

<!-- Modal editar proveedor -->
<?php include(VIEWS.'/compras/modales/modalEditarProveedor.php'); ?>

<!-- Modal nueva OP -->
<?php include(VIEWS.'/compras/modales/modalNuevaOp.php'); ?>
        
    </div>
    </div>    
</div>
</main>
<main>
<div class="w-100 d-flex justify-content-center">
        <h5 class="text-center">Compras - Proveedores</h5>
    </div>

<div class="container-lg alto d-flex">
    <div class="container">
    <div class="row">
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
                    <li><a class="dropdown-item" href="#">Editar proveedor</a></li>
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
                            <a class="abtn" type="button" data-bs-toggle="modal" data-bs-target="#resumenModal">Resumen cuenta proveedor</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group dropend btn" role="group">
                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Ordenes de Pago
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Nueva Orden de Pago</a></li>
                    <li><a class="dropdown-item" href="#">Consultar Orden de Pago</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-10" style="padding: 3em;">
            
    <?php if (!empty($respuesta) && !empty($respuesta['cuenta'])) {
    // Accede al primer elemento para obtener el nombre del proveedor
    $firstItem = $respuesta['cuenta'][0];
    $proveedor = $firstItem->getProveedor_nombre( );
    } else {
        $proveedor = 'Proveedor sin movimientos';
    } ?>
    <h5 class="text-center"><?php echo $proveedor; ?></h5>
    <button type="button" class="btn" style="background-color: #ffaf38;" data-bs-toggle="modal" data-bs-target="#modalCompra">Nueva Compra</button>
    <a href="/ops/create">Nueva OP</a>
    <button type="button" class="btn" role="button" style="background-color: #ffaf38;" data-bs-toggle="modal" data-bs-target="#resumenModal">Resumen de Cuenta</button>

<div>
<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Nro comprobante</th>
            <th>Importe</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $respuesta['cuenta'] as $p ): ?>
        <tr>
            <td><?php echo $p->getFecha( ); ?></td>
            <td><?php echo $p->getNumero( ); ?></td>
            <td><?php echo $p->getTotal( ); ?></td>
            <td>
                <a href="">Ver</a>
                <a href="">Imprimir</a>
            </td>
        </tr>
        <?php endforeach; ?>
            </td>
        </tr>
    </tbody>
    <a href="index.php?entidad=compras&accion=create">Saldo: $150</a>
</table>
</div>

        </div>

        
    </div>
    </div>    
</div>
</main>



<div class="header">
    
    <?php if (!empty($respuesta) && !empty($respuesta['cuenta'])) {
    // Accede al primer elemento para obtener el nombre del proveedor
    $firstItem = $respuesta['cuenta'][0];
    $proveedor = $firstItem->getProveedor_nombre( );
    } else {
        $proveedor = 'Proveedor sin movimientos';
    } ?>
    <h2><?php echo $proveedor; ?></h2>
    <button type="button" class="btn" style="background-color: #ffaf38;" data-bs-toggle="modal" data-bs-target="#modalCompra">Nueva Compra</button>
    <a href="/ops/create">Nueva OP</a>
    <button type="button" class="btn" role="button" style="background-color: #ffaf38;" data-bs-toggle="modal" data-bs-target="#resumenModal">Resumen de Cuenta</button>
</div>
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
<!-- Modal fecha-->
<div class="modal fade" id="resumenModal" tabindex="-1" role="dialog" aria-labelledby="resumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="resumenModalLabel">Resumen Cuenta</h5>

        </div>
        <form action="/index.php?entidad=compras&accion=resumenCuenta" method="POST">
        <div class="modal-body">
            <div class="form-group">
            <label for="fecha-inicial">Fecha Inicial</label>
            <input type="date" class="form-control" id="fecha-inicial" name="fecha_inicial" required>
            </div>
            <div class="form-group">
            <label for="fecha-final">Fecha Final</label>
            <input type="date" class="form-control" id="fecha-final" name="fecha_final" required>
            </div>
            <input type="hidden" name="proveedor_id" value="<?php echo $firstItem->getProveedor_id(); ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn"  data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn" style="background-color: #ffaf38;">Consultar</button>
        </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal nueva compra-->

<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCompraLabel">Crear Nueva Compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
        <form id="formNuevaCompra" method="post" action="/index.php?entidad=compras&accion=create">
          <div class="mb-3">
            <label for="proveedor_autocomplete_modal">Proveedor</label>
            <input type="text" class="form-control" id="proveedor_autocomplete_modal" placeholder="Buscar proveedor...">
            <input type="hidden" id="proveedor_id_modal" name="proveedor_id">
          </div>
          <div class="mb-3">
            <label for="letra" class="form-label">Letra</label>
            <input type="text" class="form-control" id="letra" name="letra" placeholder="1-> A / 2->B / 3->C" required>
          </div>
          <div>
        <label for="suc">Sucursal</label>
        <input type="text" class="form-control" name="suc" id="suc" placeholder="Número de Sucursal del comprobante" autocomplete="off" required>
    </div>
    <div>
        <label for="numero">Número de comprobante</label>
        <input type="text" class="form-control" name="numero" id="numero" placeholder="Número de la Factura" autocomplete="off" required>
    </div>
    <div>
        <label for="fecha">Fecha</label>
        <input type="date" class="form-control" name="fecha" id="fecha" required>
    </div>
    <div>
        <label for="neto">Neto</label>
        <input type="text" class="form-control" name="neto" id="neto" placeholder="Importe Neto" autocomplete="off" required>
    </div>
    <div>
        <label for="iva">IVA</label>
        <input type="text" class="form-control" name="iva" id="iva" placeholder="Total de IVA" autocomplete="off">
    </div>
    <div>
        <label for="iva">Exento</label>
        <input type="text" class="form-control" name="exento" id="exento" placeholder="Total exento" autocomplete="off">
    </div>

          <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" class="form-control" id="total" name="total" required>
          </div>
          <div class="mb-3">
            <label for="obs" class="form-label">Observaciones</label>
            <input type="text" class="form-control" id="obs" name="obs">
          </div>
          <button type="submit" class="btn" style="background-color: #ffaf38;">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

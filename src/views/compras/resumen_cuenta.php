<?php
$proveedor = $respuesta['respuesta']['nombre_proveedor'];
?>

<h4 style="margin: 25px 0px;" class="text-center">Resumen de Cuenta de <?php echo $proveedor; ?></h4>
<div style="display: flex; justify-content: center;">
<div style="width: 80%;">
<table class="table table-striped">
    <thead>
        <tr class="table-secondary">
            <tr>
                <th colspan="6" class="text-center">Período:   <?php echo $fecha_inicial; ?> al <?php echo $fecha_final; ?><br>Saldo Inicial: <?php echo $saldo_inicial; ?></th>
            </tr>
            <th>Fecha</th>
            <th>Número</th>
            <th>Compra</th>
            <th>Pago</th>
            <th>Saldo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($movimientos) && is_array($movimientos)): ?>
            <?php foreach ($movimientos as $mov): ?>
                <!-- Aplicar color a toda la fila dependiendo del tipo -->
                <tr style="color: <?php echo ($mov['tipo'] == 'compra') ? 'red' : 'green'; ?>;">
                    <td style="color: <?php echo ($mov['tipo'] == 'compra') ? 'red' : 'green'; ?>;"><?php echo $mov['fecha']; ?></td>
                    <td style="color: <?php echo ($mov['tipo'] == 'compra') ? 'red' : 'green'; ?>;"><?php echo $mov['numero']; ?></td>
                    <!-- Si el tipo es 'pago', muestra el número aquí -->
                    <td style="color: <?php echo ($mov['tipo'] == 'compra') ? 'red' : 'green'; ?>;"><?php echo ($mov['tipo'] == 'compra') ? $mov['importe'] : ''; ?></td>
                    <!-- Si el tipo es 'compra', muestra el número aquí -->
                    <td style="color: <?php echo ($mov['tipo'] == 'compra') ? 'red' : 'green'; ?>;"><?php echo ($mov['tipo'] == 'pago') ? $mov['importe'] : ''; ?></td>
                    <td><?php echo $mov['saldo']; ?></td>
                    <td>
                        <a href="#" class="btnVerDoc" data-id="<?php echo $mov['id']; ?>" data-nro="<?php echo $mov['numero']; ?>" data-tipo="<?php echo $mov['tipo']?>" data-proveedor="<?php echo $proveedor ?>"  data-bs-toggle="modal" data-bs-target="">Ver</a>
                        <!-- <a href="pdf/create" class="btnVerDoc">Imprimir</a> -->
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
            <th colspan="6" class="text-center">Saldo final: <?php echo $saldo_final; ?></th>
            </tfoot>
</table>


</div>
</div>

<?php include(VIEWS.'/compras/modales/modalVerOp.php') ?>
<?php include(VIEWS.'/compras/modales/modalVerCompra.php') ?>
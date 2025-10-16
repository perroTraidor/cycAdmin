
<!-- Modal ver Orden de pago -->

<div class="modal fade" id="modalVerOp" tabindex="-1" aria-labelledby="modalVerOpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerOpLabel">Consulta Orden de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVerOp" method="post" action="/index.php?entidad=ops&accion=obtenerDatosOp">
                <div class="row">
                    <div class="col">
                    <label for="proveedores_id_prov" class="form-label">Proveedor Nro</label>
                    <input type="text" class="form-control" id="proveedores_id_prov" name="proveedores_id_prov" readonly>
                    </div>
                    <div class="col">
                    <label for="proveedor" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" id="proveedor" name="proveedor" disabled>
                    </div>
                </div>
                
                <div class="row">
                <div class="col">
                <label for="numero">Nro de OP</label>
                <input type="text" class="form-control" id="numero" placeholder="Nro de OP" disabled>
                <input type="hidden" id="op_id" name="op_id">
            </div>
            
        <div class="col">
            <label for="fechaop">Fecha</label>
            <input type="date" class="col form-control" name="fechaop" id="fechaop" disabled>
        </div>
        </div>

        <hr>

        <div class="pt-2 mx-auto">
            <p class="text-center mx-auto"><b>Erogaciones (Pagos y Valores)</b></p>
        </div>
        <div class="row px-5">
            <table class="tbl" id="tablaFormasPago">
                <thead>
                    <tr class="px-4">
                        <th>Forma de Pago</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be inserted dynamically using JS -->
                </tbody>
            </table>
        </div>

        <hr>

        <div class="pt-2 mx-auto">
            <p class="text-center mx-auto"><b>Imputaciones</b></p>
        </div>
        <div class="row px-5">
            <table class="tbl" id="tablaImputaciones">
                <thead>
                    <tr class="px-4">
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Imputado</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be inserted dynamically using JS -->
                </tbody>
            </table>
        </div>

        <hr>

        <div class="mb-3">
            <label for="importe" class="form-label">Total cancelado</label>
            <input type="text" class="form-control" id="importe" name="importe" disabled>
        </div>
            
            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" id="generarPDF" class="btn">Generar PDF</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Form oculto para mandar los datos al PDF -->

<form id="formGenerarPDF" method="POST" action="index.php?entidad=pdf&accion=createPDF" target="_blank">
    <input type="hidden" name="datosOrden[numero]" id="hiddenNumero">
    <input type="hidden" name="datosOrden[fecha]" id="hiddenFecha">
    <input type="hidden" name="datosOrden[proveedor]" id="hiddenProveedor">
    <input type="hidden" name="datosOrden[proveedor_id]" id="hiddenProveedorId">
    <input type="hidden" name="datosOrden[total]" id="hiddenTotal">

    <!-- Formas de pago -->
    <input type="hidden" name="formasPago" id="hiddenFormasPago">

    <!-- Imputaciones a facturas -->
    <input type="hidden" name="imputaciones" id="hiddenImputaciones">

    <!-- Array para los valores entregados -->
    <!-- <input type="hidden" name="valoresEntregados" id="hiddenValoresEntregados">
    
    <input type="hidden" name="tipoDocumento" value="pago"> -->
</form>

<script>
$('#generarPDF').on('click', function() {
    // Asignar valores a los inputs ocultos del formulario
    $('#hiddenNumero').val($('#numero').val());
    $('#hiddenFecha').val($('#fechaop').val());
    $('#hiddenProveedor').val($('#proveedor').val());
    $('#hiddenProveedorId').val($('#proveedores_id_prov').val());
    $('#hiddenTotal').val($('#importe').val());

    // Serializar las formas de pago
    var formasPago = [];
        $('#tablaFormasPago tbody tr').each(function() {
            formasPago.push({
                id: $(this).data('id'),
                forma: $(this).find('td').eq(0).text(),
                importe: $(this).find('td').eq(1).text()
            });
        });
        $('#hiddenFormasPago').val(JSON.stringify(formasPago));

        // Serializar las imputaciones
        var imputaciones = [];
        $('#tablaImputaciones tbody tr').each(function() {
            imputaciones.push({
                numero_factura: $(this).find('td').eq(0).text(),
                fecha_factura: $(this).find('td').eq(1).text(),
                importe_imputado: $(this).find('td').eq(2).text()
            });
        });
        $('#hiddenImputaciones').val(JSON.stringify(imputaciones));

        // Enviar el formulario para generar el PDF
        $('#formGenerarPDF').submit();

});


</script>


<!-- Modal Nueva Orden de Pago -->
<div class="modal fade" id="modalNuevaOp" tabindex="-1" aria-labelledby="modalNuevaOpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaOpLabel">Crear Nueva Orden de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevaOp" method="post" action="/index.php?entidad=ops&accion=create">
                    <div class="row">
                        <div class="col">
                            <label for="proveedor_autocomplete_op">Proveedor</label>
                            <input type="text" class="form-control" id="proveedor_autocomplete_op" placeholder="Buscar proveedor...">
                            <input type="hidden" id="proveedor_id_op" name="proveedor_id">
                        </div>
                        <div class="col">
                            <label for="numero">Número de comprobante</label>
                            <input type="text" class="form-control" name="numero" id="numero" placeholder="Número de OP" readonly>
                        </div>
                        <div class="col">
                            <label for="fechaop">Fecha</label>
                            <input type="date" class="form-control" name="fechaop" id="fechaop" required>
                        </div>
                    </div>

            <!-- Forma de Pago -->
            <div class="form-group row g-3 align-items-center mt-3">
                <div class="col-auto">
                        <label for="forma col-form-label">Forma de Pago</label>
                        </div>
                        <div class="col-auto">
                        <select class="form-control" id="forma">
                            <option selected>Elije la forma de pago</option>
                            <option value="efe">Efectivo</option>
                            <option value="tra">Transferencia</option>
                            <option value="che">Cheque</option>
                            <option value="ech">Echeq</option>
                        </select>
                        </div>
                        <div class="col-auto">
                        <span id="formaHelp" class="form-text">
                        Por cada forma de pago se arma un subtotal
                        </span>
                        </div>
                    </div>

                    <!-- Contenedor de los renglones de pagos (efectivo, transferencia, cheques, echeqs) -->
                    <div id="formaPagoContainer" class="renglonOp"></div>

                    <input type="hidden" name="forma_pagos[]" id="hiddenFormaPago">  <!-- Para las formas de pago -->
                    <input type="hidden" name="subtotales[]" id="hiddenSubtotales">  <!-- Para los subtotales -->

                    <!-- Contenedor para los inputs hidden de las facturas imputadas -->
                    <div id="facturasImputadasContainer"></div>

                    <!-- Total de la OP -->
                    <div class="form-group mt-3 row g-3 align-items-center">
                        <div class="col-auto">
                        <label for="grandTotalOp">Total de la OP</label>
                        </div>
                        <div class="col-auto">
                        <input type="text" class="form-control" id="grandTotalOp" name="grandTotalOp" readonly>
                        </div>
                        <div class="col-auto">
                        <span id="grandtotalHelp" class="form-text">
                        <- Este es el total del pago
                        </span>
                        </div>
                        <div class="col-auto">
                        <button type="button" id="BuscaFacturas" class="btn">
                        Selecionar Facturas
                        </button>
                        </div>
                    </div>

                    

                    <div class="mb-3 mt-3">
                        <label for="obs" class="form-label">Observaciones</label>
                        <input type="text" class="form-control" id="obs" name="obs">
                    </div>
            </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn">Guardar</button>
                    </div>
        </div>
    </div>
</div>




<!-- Modal Cheques/Echeqs -->
<?php include(VIEWS.'/compras/modales/nuevaOp/modalChequesEcheqs.php' ) ?>


<!-- Modal para seleccionar las facturas -->
<?php include(VIEWS.'/compras/modales/nuevaOp/modalFacturas.php' ) ?>

<script src="<?= BASE_URL ?>assets/js/opScripts.js"></script>

<!-- Modal Cheques/Echeqs -->
<div class="modal fade" id="modalChequesEcheqs" tabindex="-1" aria-labelledby="modalChequesEcheqsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChequesEcheqsLabel">Agregar Cheques/Echeqs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    
                </div>
                <div class="modal-body">
                    <form id="formChequesEcheqs">
                        <div class="form-row row">
                            <div class="form-group col-4 mb-3">
                                <label for="banco">Banco</label>
                                <input type="text" class="form-control" id="banco">
                            </div>
                            <div class="form-group col-4 mb-3">
                                <label for="fechaPago">Fecha de Pago</label>
                                <input type="date" class="form-control" id="fechaPago">
                            </div>
                            <div class="form-group col-4 mb-3">
                                <label for="numeroCheque">Número de Cheque</label>
                                <input type="text" class="form-control" id="numeroCheque">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col mb-3">
                                <label for="importeCheque">Importe</label>
                                <input type="text" class="form-control" id="importeCheque">
                            </div>
                            <div class="form-group col mb-3">
                                <label for="subtotalCheques">Subtotal de Cheques</label>
                                <input type="text" class="form-control" id="subtotalCheques" readonly>
                            </div>
                        </div>
                    </form>

                    <!-- Contenedor de los renglones de cheques ingresados -->
                    <div id="chequesContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addCheque" class="btn btn-success">Agregar Cheque/Echeq</button>
                    <button type="button" id="cerrarModalCheques" class="btn btn-primary">Aceptar</button>
                    
                </div>
            </div>
        </div>
    </div>


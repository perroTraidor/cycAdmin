<!-- Modal para seleccionar las facturas -->
<div class="modal fade" id="modalFacturas" tabindex="-1" aria-labelledby="modalFacturasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalFacturasLabel">Seleccione las facturas a pagar e ingrese el importe</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <div>
                <h5 id="totalDisponible">Total del pago para aplicar: $ 0.00</h5>
            </div>
            <hr>
            <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nro FC</th>
                        <th>Fecha</th>
                        <th>Total Original</th>
                        <th>Saldo</th>
                        <th>Monto a aplicar</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table> 
            </div>
            <div>
                <h5 id="totalImputar">Total de Imputaciones: $ 0.00</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn">Confirmar</button>
            </div>
            </div>
        </div>
    </div>
</div>

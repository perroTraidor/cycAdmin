
<!-- Modal consulta compra-->

<div class="modal fade" id="modalVerCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCompraLabel">Consulta Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVerCompra">
                <div class="row">
                <div class="col">
                <label for="proveedor_autocomplete_compra">Nro Proveedor</label>
                <input type="text" class="form-control" id="proveedor_id" placeholder="Nro de proveedor" disabled>
            </div>
                <div class="col">
                <label for="proveedor">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" placeholder="Nombre del proveedor" disabled>
            </div>
            <div class="col">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" disabled>
            </div>
            </div>
            <div class="row">
            <div class="col">
                <label for="letra">Letra</label>
                <input type="text" class="form-control" id="letra" name="letra" placeholder="1-> A / 2->B / 3->C" disabled>
            </div>
            <div class="col">
            <label for="suc">Sucursal</label>
            <input type="text" class="form-control" name="suc" id="suc" placeholder="Número de Sucursal del comprobante" autocomplete="off" disabled>
        </div>
        <div class="col">
            <label for="numero">Número de comprobante</label>
            <input type="text" class="form-control" name="numero" id="numero" placeholder="Número de la Factura" autocomplete="off" disabled>
        </div>
        </div>
        <div class="row">
        <div class="col">
            <label for="neto">Neto</label>
            <input type="text" class="form-control" name="neto" id="neto" placeholder="Importe Neto" autocomplete="off" disabled>
        </div>
        <div class="col">
            <label for="iva">IVA</label>
            <input type="text" class="form-control" name="iva21" id="iva21" placeholder="Total de IVA" autocomplete="off" disabled>
        </div>
        <div class="col">
            <label for="iva">Exento</label>
            <input type="text" class="form-control" name="exento" id="exento" placeholder="Total exento" autocomplete="off" disabled>
        </div>

            <div class="col">
                <label for="total">Total</label>
                <input type="text" class="form-control" id="total" name="total" disabled>
            </div>
            </div>
            <div class="mb-3">
                <label for="obs" class="form-label">Observaciones</label>
                <input type="text" class="form-control" id="obs" name="obs" disabled>
            </div>
            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>

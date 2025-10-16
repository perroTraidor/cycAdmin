
<!-- Modal nueva compra-->

<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCompraLabel">Crear Nueva Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <!-- Aquí mostramos el error si existe -->
            <!-- Contenedor del mensaje de error (se mostrará vía JS) -->
            <div id="errorAlert" class="alert alert-danger d-none"></div>

                <!-- Formulario para cargar la compra -->
                <form id="formNuevaCompra" method="post" action="/index.php?entidad=compras&accion=create">
                <div class="row">
                <div class="mb-3 col">
                <label for="proveedor_autocomplete_compra">Proveedor</label>
                <input type="text" class="form-control" id="proveedor_autocomplete_compra" placeholder="Buscar proveedor...">
                <input type="hidden" id="proveedor_id_compra" name="proveedor_id">
            </div>
            <div class="mb-3 col">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" name="fecha" id="fecha" required>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col">
                <label for="letra">Letra</label>
                <input type="text" class="form-control" id="letra" name="letra" placeholder="1-> A / 2->B / 3->C" required>
            </div>
            <div class="mb-3 col">
            <label for="suc">Sucursal</label>
            <input type="text" class="form-control" name="suc" id="suc" placeholder="Número de Sucursal del comprobante" autocomplete="off" required>
        </div>
        <div class="mb-3 col">
            <label for="numero">Número de comprobante</label>
            <input type="text" class="form-control" name="numero" id="numero" placeholder="Número de la Factura" autocomplete="off" required>
        </div>
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
                <input type="text" class="form-control" id="total" name="total" placeholder="Total del documento" required>
            </div>
            <div class="mb-3">
                <label for="obs" class="form-label">Observaciones</label>
                <input type="text" class="form-control" id="obs" name="obs">
            </div>
            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" id="guardarCompra" class="btn">Guardar</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const netoInput = document.getElementById('neto');
        const ivaInput = document.getElementById('iva');
        const exentoInput = document.getElementById('exento');
        const totalInput = document.getElementById('total');

        function calcularIvaYTotal() {
            let neto = parseFloat(netoInput.value) || 0;
            let exento = parseFloat(exentoInput.value) || 0;
            let iva = neto * 0.21;
            let total = neto + iva + exento;

            ivaInput.value = iva.toFixed(2);
            totalInput.value = total.toFixed(2);
        }

        netoInput.addEventListener('input', calcularIvaYTotal);
        exentoInput.addEventListener('input', calcularIvaYTotal);
    });
    </script>

<script>
// Manejar el envío del formulario vía AJAX
$('#guardarCompra').on('click', function(e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var formData = $('#formNuevaCompra').serialize();

    // Enviar los datos por AJAX
    $.ajax({
        url: '/compras/create',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Si es exitoso, cerrar el modal y recargar la página
                $('#modalNuevaCompra').modal('hide');
                location.reload();  // Recargar la página para reflejar los cambios
            } else {
                // Si hay un error, mostrar el mensaje de error
                $('#errorAlert').text(response.error).removeClass('d-none');
            }
        },
        error: function() {
            // Mostrar un mensaje de error genérico si falla la llamada AJAX
            $('#errorAlert').text('Error al procesar la solicitud.').removeClass('d-none');
        }
    });
});
</script>

    <!-- Modal fecha resumen de cuenta-->
    <div class="modal fade" id="resumenModalId" tabindex="-1" role="dialog" aria-labelledby="resumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resumenIdModalLabel">Rango de fechas</h5>

            </div>
                <form action="/index.php?entidad=compras&accion=resumenCuenta" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="hidden" id="proveedor_id_resumen" name="proveedor_id">
                        </div>
                            <div class="form-group">
                                <label for="fecha-inicial">Fecha Inicial</label>
            <input type="date" class="form-control" id="fecha-inicial" name="fecha_inicial" required>
            </div>
            <div class="form-group">
            <label for="fecha-final">Fecha Final</label>
            <input type="date" class="form-control" id="fecha-final" name="fecha_final" required>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn">Consultar</button>
        </div>
        </form>
        </div>
    </div>
</div>
<script>
    // Usando jQuery para capturar el evento cuando se abre el modal
    $('#resumenModalId').on('show.bs.modal', function (event) {
        // Obtiene el botón que abrió el modal
        var button = $(event.relatedTarget);
        
        // Encuentra la fila padre del botón
        var row = button.closest('tr');
        
        // Encuentra la primera columna (que contiene el ID del proveedor) y toma su texto
        var proveedorId = row.find('td:first').text().trim();
        
        // Verifica que proveedorId esté definido
        console.log('ID del proveedor: ', proveedorId);  // Para depuración
        
        // Actualiza el campo oculto en el modal con el ID del proveedor
        var modal = $(this);
        modal.find('#proveedor_id_resumen').val(proveedorId);
    });
</script>
    
    <!-- Modal editar proveedor -->

    <div class="modal fade" id="modalEditarProveedor" tabindex="-1" aria-labelledby="modalEditarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProveedorLabel">Buscar proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form id="formEditarProveedor" method="post" action="/index.php?entidad=proveedores&accion=edit">
                <div class="mb-3">
                <label for="proveedor_autocomplete_buscar">Proveedor</label>
                <input type="text" class="form-control" id="proveedor_autocomplete_buscar" placeholder="Buscar proveedor...">
                <input type="hidden" id="proveedor_id_buscar" name="proveedor_id">
            </div>
            <div>
        <label for="nombre_proveedor">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Proveedor" autocomplete="off">
    </div>
    <div>
        <label for="domicilio_proveedor">Domicilio</label>
        <input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio" autocomplete="off">
    </div>
    <div>
        <label for="telefono_proveedor">Telefono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" autocomplete="off">
    </div>
    <div>
        <label for="cuit_proveedor">CUIT</label>
        <input type="text" class="form-control" name="cuit" id="cuit" placeholder="CUIT (Sin guiones ni espacios" autocomplete="off" disabled>
    </div>
    <div>
        <label for="email_proveedor">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email (Sin guiones ni espacios" autocomplete="off">
    </div>

            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn">Guardar cambios</button>
            
            </div>
        </form>
        </div>
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
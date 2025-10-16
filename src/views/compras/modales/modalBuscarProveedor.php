    
    <!-- Modal buscar proveedor -->

    <div class="modal fade" id="modalBuscarProveedor" tabindex="-1" aria-labelledby="modalBuscarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuscarProveedorLabel">Buscar proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form id="formBuscarProveedor" method="post" action="/index.php?entidad=proveedores&accion=obtenerDatosProveedor">
                <div class="mb-3">
                <label for="proveedor_autocomplete_buscar">Proveedor</label>
                <input type="text" class="form-control" id="proveedor_autocomplete_buscar" placeholder="Buscar proveedor...">
                <input type="hidden" id="proveedor_id_buscar" name="proveedor_id">
            </div>
            <div>
        <label for="nombre_proveedor">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Proveedor" autocomplete="off" readonly>
    </div>
    <div>
        <label for="domicilio_proveedor">Domicilio</label>
        <input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio" autocomplete="off" readonly>
    </div>
    <div>
        <label for="telefono_proveedor">Telefono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" autocomplete="off" readonly>
    </div>
    <div>
        <label for="cuit_proveedor">CUIT</label>
        <input type="text" class="form-control" name="cuit" id="cuit" placeholder="CUIT (Sin guiones ni espacios)" autocomplete="off" disabled>
    </div>
    <div>
        <label for="email_proveedor">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" readonly>
    </div>

            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>

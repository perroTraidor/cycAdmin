
    <!-- Modal cargar proveedor -->
    <div class="modal fade" id="newProveedorModal" tabindex="-1" aria-labelledby="newProveedorModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCompraLabel">Cargar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevoProveedor" method="post" action="/index.php?entidad=proveedores&accion=create">
                <div>
        <label for="nombre_proveedor">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Proveedor" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getNombre( ) : '';  ?>">
    </div>
    <div>
        <label for="domicilio_proveedor">Domicilio</label>
        <input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio" autocomplete="off" value="<?php echo isset ($respuesta['form']['values']) ? $respuesta['form']['values']->getDomicilio( ) : '';  ?>">
    </div>
    <div>
        <label for="telefono_proveedor">Telefono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getTelefono( ) : '';  ?>">
    </div>
    <div>
        <label for="cuit_proveedor">CUIT</label>
        <input type="text" class="form-control" name="cuit" id="cuit" placeholder="CUIT (Sin guiones ni espacios)" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getCuit( ) : '';  ?>">
    </div>
    <div>
        <label for="email_proveedor">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getEmail( ) : '';  ?>">
    </div>
            
            <div class="modal-footer">
            <button type="button" class="cancelbtn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn">Guardar</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>

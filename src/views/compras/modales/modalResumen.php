
    <!-- Modal fecha resumen de cuenta-->
    <div class="modal fade" id="resumenModal" tabindex="-1" role="dialog" aria-labelledby="resumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resumenModalLabel">Resumen Cuenta</h5>

            </div>
                <form action="/index.php?entidad=compras&accion=resumenCuenta" method="POST">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="proveedor_autocomplete_resumen">Proveedor</label>
                                <input type="text" class="form-control mb-2" id="proveedor_autocomplete_resumen" placeholder="Buscar proveedor...">
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

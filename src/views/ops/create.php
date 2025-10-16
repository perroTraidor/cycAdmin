<h2><?php echo $respuesta['form']['title']; ?></h2>
<form method="post" action="<?php echo $respuesta['form']['action']; ?>">
    <div>
    <div>
    <label for="proveedor_autocomplete">Proveedor</label>
    <input type="text" id="proveedor_autocomplete" name="proveedor_id" placeholder="Buscar proveedor..." autocomplete="off">
    <input type="hidden" id="proveedor_id" name="proveedor_id">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">

<script>
    $(function() {
        $('#proveedor_autocomplete').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/index.php?entidad=proveedores&accion=search',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.nombre,
                                value: item.id
                            };
                        }));
                    }
                });
            },
            select: function(event, ui) {
                $('#proveedor_id').val(ui.item.value);
                $('#proveedor_autocomplete').val(ui.item.label);
            }
        });
    });
</script>

</div>
<form method="post" action="<?php echo $respuesta['form']['action']; ?>">



    <div>
        <label for="fechaop">Fecha</label>
        <input type="date" name="fechaop" id="fechaop" placeholder="Fecha" autocomplete="off" required>
    </div>
    <div>
        <label for="forma">Forma de Pago</label>
        <input type="text" name="forma" id="forma" placeholder="Forma de Pago" autocomplete="off" required>
    </div>
    <div>
        <label for="importe">Importe Cancelado</label>
        <input type="text" name="importe" id="importe" placeholder="Importe a cancelar" autocomplete="off" required>
    </div>

    <div>
        <button type="submit"><?php echo $respuesta['form']['button']; ?></button>
        <button type="button" onclick="location.href='/compras'">Cancelar</button>
    </div>
</form>

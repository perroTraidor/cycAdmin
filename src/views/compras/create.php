


<div style="text-align: center;">
<h2><?php echo $respuesta['form']['title']; ?></h2>
</div>
<form method="post" action="<?php echo $respuesta['form']['action']; ?>">
    <div style="display: flex; align-items: center; margin: 3em">
    <div>
    <label for="proveedor_autocomplete" style="font-size:1.5rem;" >Proveedor</label>
    
    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
    
    <input class="form-control me-2" type="text" id="proveedor_autocomplete" name="proveedor_id" placeholder="Buscar proveedor..." autocomplete="off">
    <input type="hidden" id="proveedor_id" name="proveedor_id">
</div>

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



<form method="post" action="<?php echo $respuesta['form']['action']; ?>">



    </div>

    <div>
        <label for="letra">Letra</label>
        <input type="text" name="letra" id="letra" placeholder="1->A 2->C" autocomplete="off" required>
    </div>
    <div>
        <label for="suc">Sucursal</label>
        <input type="text" name="suc" id="suc" placeholder="Número de Sucursal del comprobante" autocomplete="off" required>
    </div>
    <div>
        <label for="numero">Número de comprobante</label>
        <input type="text" name="numero" id="numero" placeholder="Número de la Factura" autocomplete="off" required>
    </div>
    <div>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" required>
    </div>
    <div>
        <label for="neto">Neto</label>
        <input type="text" name="neto" id="neto" placeholder="Importe Neto" autocomplete="off" required>
    </div>
    <div>
        <label for="iva">IVA</label>
        <input type="text" name="iva" id="iva" placeholder="Total de IVA" autocomplete="off" required>
    </div>
    <div>
        <label for="exento">Exento</label>
        <input type="text" name="exento" id="exento" placeholder="Importe exento" autocomplete="off" required>
    </div>
    <div>
        <label for="total">Total</label>
        <input type="text" name="total" id="total" placeholder="Total de la Compra" autocomplete="off" required>
    </div>

    <div>
        <label for="obs">Observaciones</label>
        <input type="text" name="obs" id="obs" placeholder="Observaciones" autocomplete="off" required>
    </div>
    
    
    <div>
        <button type="submit" class="btn" style="background-color: #ffaf38;"><?php echo $respuesta['form']['button']; ?></button>
        <a type="button" class="btn" href='/proveedores'>Cancelar</a>
    </div>
</form>

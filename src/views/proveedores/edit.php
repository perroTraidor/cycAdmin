<h2><?php echo $respuesta['form']['title']; ?></h2>
<form method="post" action="<?php echo $respuesta['form']['action']; ?>">
    <div>
        <label for="nombre_proveedor">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Proveedor" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getNombre( ) : '';  ?>">
    </div>
    <div>
        <label for="domicilio_proveedor">Domicilio</label>
        <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio" autocomplete="off" value="<?php echo isset ($respuesta['form']['values']) ? $respuesta['form']['values']->getDomicilio( ) : '';  ?>">
    </div>
    <div>
        <label for="telefono_proveedor">Telefono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Teléfono" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getTelefono( ) : '';  ?>">
    </div>
    <div>
        <label for="cuit_proveedor">CUIT</label>
        <input type="text" name="cuit" id="cuit" placeholder="CUIT (Sin guiones ni espacios" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getCuit( ) : '';  ?>">
    </div>
    <div>
        <label for="email_proveedor">Email</label>
        <input type="text" name="email" id="email" placeholder="Email (Sin guiones ni espacios" autocomplete="off" value="<?php echo isset($respuesta['form']['values']) ? $respuesta['form']['values']->getEmail( ) : '';  ?>">
    </div>
    <div style="margin-top: 3em;">
    <button class="btn" type="submit" style="background-color: #ffaf38;"><?php echo $respuesta['form']['button']; ?></button>
        <button class="btn" type="button" onclick="location.href='/index.php?entidad=proveedores&accion=list'" style="background-color: #ffaf38;">Cancelar</button>
    </div>
</form>
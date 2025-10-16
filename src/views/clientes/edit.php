<h2><?php echo $respuesta['form']['title']; ?></h2>

<form method="post" action="editar_cliente.php">
    <div>
        <label for="nombre_cliente">Nombre</label>
        <input type="text" name="nombre_cliente" id="nombre_cliente" placeholder="Nombre del cliente" autocomplete="off" value="">
    </div>
    <div>
        <label for="telefono_cliente">Telefono</label>
        <input type="number" name="telefono_cliente" id="telefono_cliente" placeholder="Telefono del cliente" autocomplete="off" value="">
    </div>
    <div>
        <label for="email_cliente">Email</label>
        <input type="text" name="email_cliente" id="email_cliente" placeholder="Email del cliente" autocomplete="off" value="">
    </div>
    <div>
        <label for="cuit_cliente">CUIT</label>
        <input type="text" name="cuit_cliente" id="cuit_cliente" placeholder="CUIT del cliente" autocomplete="off" value="">
    </div>
    <div>
        <button type="submit"><?php echo $respuesta['form']['button']; ?></button>
        <button type="button" onclick="location.href='index.php?entidad=clientes'">Cancelar</button>
    </div>
</form>
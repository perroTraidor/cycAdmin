<div class="header">
    <h2>Proveedor <?php echo $respuesta['form']['values']->getNombre( ); ?></h2>
    <a href="/proveedores/<?php echo $respuesta['form']['values']->getId( ); ?>/edit">Editar Datos</a>
</div>
<table class="view_p">

    <tbody>
            <tr>
                <th scope="row">Código</th>
                <td><?php echo $respuesta['form']['values']->getId( ); ?></td>
            </tr>
            <tr>
                <th scope="row">Razón Social</th>
                <td><?php echo $respuesta['form']['values']->getNombre( ); ?></td>
            </tr>
            <tr>
                <th scope="row">Domicilio</th>
                <td><?php echo $respuesta['form']['values']->getDomicilio( ); ?></td>
            </tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td><?php echo $respuesta['form']['values']->getTelefono( ); ?></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td><?php echo $respuesta['form']['values']->getEmail( ); ?></td>
            </tr>
            <tr>
                <th scope="row">CUIT</th>
                <td><?php echo $respuesta['form']['values']->getCuit( ); ?></td>
            </tr>
    </tbody>
</table> 


<div class="header">
    <h2>Lista Proveedores</h2>

    <a class="btn" role="button" style="background-color: #ffaf38;" href="/proveedores/create">Agregar proveedor</a>

</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $respuesta['proveedores'] as $p ): ?>
        <tr>
            <td><?php echo $p->getId( ); ?></td>
            <td><?php echo $p->getNombre( ); ?></td>
            <td><?php echo $p->getEmail( ); ?></td>
            <td>
                <a href="proveedores/<?php echo $p->getId( ); ?>/edit">Editar</a>
                <a class="btn" role="button" style="background-color: #ffaf38;"  href="compras/<?php echo $p->getId( ); ?>/list">Cta Cte</a>
            </td>
        </tr>
        <?php endforeach; ?>
            </td>
        </tr>



    </tbody>
</table> 
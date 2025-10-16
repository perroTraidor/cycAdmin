<div class="header">
    <h2>Lista Clientes</h2>
    <a href="index.php?entidad=clientes&accion=create">Agregar cliente</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>15</td>
            <td>Groso Hnos.</td>
            <td>123456</td>
            <td>zarpado@lksf.com</td>
            <td>
                <a href="index.php?entidad=clientes&accion=edit">Editar</a>
                <a href="">Cta Cte</a>
                <a href="">Eliminar</a><!--esto va a un php que elimina y vuelve a la vista por defecto-->
            </td>
        </tr>
        <tr>
            <td>18</td>
            <td>Repuestos HF</td>
            <td>654987</td>
            <td>zarpad@hf.com</td>
            <td>
                <a href="index.php?entidad=clientes&accion=edit">Editar</a>
                <a href="">Cta Cte</a>
                <a href="">Eliminar</a><!--esto va a un php que elimina y vuelve a la vista por defecto-->
            </td>
        </tr>
        <tr>
            <td>258</td>
            <td>Que repuestito Papá</td>
            <td>654654321</td>
            <td>zarpado@repuestito.com</td>
            <td>
                <a href="index.php?entidad=clientes&accion=edit">Editar</a>
                <a href="">Cta Cte</a>
                <a href="">Eliminar</a><!--esto va a un php que elimina y vuelve a la vista por defecto-->
            </td>
        </tr>
    </tbody>
</table>
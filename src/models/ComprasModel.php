<?PHP

namespace App\models;


use PDO;
use App\models\EntityModel;
use PDOException;
use Exception;

class ComprasModel extends EntityModel{
    protected $pdo;
    private int $id;
    private string $numero;
    private string $letra;
    private string $suc;
    private string $fecha;
    private string $neto;
    private string $iva21;
    private string $exento;
    private string $total;
    private string $proveedor_nombre;
    private string $compra_id;
    private string $proveedores_id_prov;



    public function getId( ){
        return $this->id;
    }

    public function getLetra( ){
        return $this->letra;
    }

    public function getSuc( ){
        return $this->suc;
    }

    public function getNumero( ){
        return $this->numero;
    }
    
    public function getNeto( ){
        return $this->neto;
    }
    
    public function getIva21( ){
        return $this->iva21;
    }
    
    public function getExento( ){
        return $this->exento;
    }
    
    public function getFecha( ){
        return $this->fecha;
    }

    public function getTotal( ){
        return $this->total;
    }

    public function getCompra_id( ){
        return $this->compra_id;
    }

    public function getProveedorId( ){
        return $this->proveedores_id_prov;
    }

    public function getProveedor_nombre( ){
        return $this->proveedor_nombre;
    }

    // Funcion que trae todos los proveedores, cada uno como objeto de ProveedoresModel
    public function all( $id ){
    $this->connect( );
    $stmt = $this->pdo->prepare(
        'SELECT
            c.id AS compra_id,
            c.numero AS numero,
            c.fecha AS fecha,
            c.total AS total,
            p.nombre AS proveedor_nombre,
            p.id AS proveedor_id
        FROM compras c
        JOIN proveedores p ON c.proveedores_id_prov = p.id
        WHERE c.proveedores_id_prov = :id'
        );
    $stmt->execute( [ ':id' => $id ]);
    $stmt->setFetchMode( PDO::FETCH_CLASS, ComprasModel::class );
    return $stmt->fetchAll( );
    }

    public function delete( $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'DELETE FROM proveedores WHERE ID = :id' );
        $stmt->execute( [ ':id' => $id ]);
    }

    public function insert( $post ){
        try{
        $this->connect( );
        $stmt = $this->pdo->prepare( 'INSERT INTO compras SET LETRA=:letra, SUC=:suc, NUMERO=:numero, FECHA=:fecha, NETO=:neto, IVA21=:iva, EXENTO=:exento, TOTAL=:total, OBS=:obs,PROVEEDORES_ID_PROV=:proveedores_id_prov' );
        $stmt->execute([':letra' => $post['letra'], ':suc' => $post['suc'], ':numero' => $post['numero'], ':fecha' => $post['fecha'], ':neto' => $post['neto'], ':iva' => $post['iva'], ':exento' => $post['exento'], ':total' => $post['total'],':obs' => $post['obs'], ':proveedores_id_prov' => $post['proveedor_id'] ]);
        return true;
    }
    catch (PDOException $e) {
        // Verificar si el error es de clave duplicada
        if ($e->getCode() == 23000) {  // Código de error SQL para "duplicate entry"
            // Manejo del error de factura duplicada
            throw new Exception('Ya existe una factura con ese número para el proveedor seleccionado.');
        } else {
            // Manejo de otros errores de base de datos
            throw new Exception('Ocurrió un error al guardar la factura: ' . $e->getMessage());
        }
    }
}

    public function update( $post, $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'UPDATE proveedores SET NOMBRE=:nombre, DOMICILIO=:domicilio, TELEFONO=:telefono, CUIT=:cuit WHERE ID = :id' );
        $stmt->execute( [ ':nombre' => $post['nombre'], ':domicilio' => $post['domicilio'], ':telefono' => $post['telefono'], ':cuit' => $post['cuit'], ':id' => $id, ]);
    }

    public function resumen( $id ){
    $this->connect( );
    $stmt = $this->pdo->prepare( 'SELECT id, letra, suc, numero, fecha, total FROM compras WHERE proveedores_id_prov = :id' );
    $stmt->execute( [':id'=>$id] );
    $stmt->setFetchMode( PDO::FETCH_CLASS, ProveedoresModel::class );
    return $stmt->fetchAll( );
    }

    public function obtenerSaldoInicial($proveedor_id, $fecha_inicial) {
        $this->connect();
    
        // Obtenemos la suma de las compras antes de la fecha inicial
        $stmt = $this->pdo->prepare(
            'SELECT SUM(total) AS total_compras 
            FROM compras 
            WHERE proveedores_id_prov = :proveedor_id 
            AND fecha < :fecha_inicial'
        );
        $stmt->execute([
            ':proveedor_id' => $proveedor_id,
            ':fecha_inicial' => $fecha_inicial,
        ]);
        $total_compras = $stmt->fetchColumn();
    
        // Obtenemos la suma de los pagos antes de la fecha inicial
        $stmt = $this->pdo->prepare(
            'SELECT SUM(importe) AS total_pagos 
            FROM op 
            WHERE proveedores_id_prov = :proveedor_id 
            AND fechaop < :fecha_inicial'
        );
        $stmt->execute([
            ':proveedor_id' => $proveedor_id,
            ':fecha_inicial' => $fecha_inicial,
        ]);
        $total_pagos = $stmt->fetchColumn();
    
        // Calculamos el saldo inicial
        $saldo_inicial = $total_compras - $total_pagos;
    
        return $saldo_inicial;
    }

    public function obtenerMovimientosEnRango($proveedor_id, $fecha_inicial, $fecha_final) {
        $this->connect();

        $stmt = $this->pdo->prepare(
            '(SELECT
                c.id AS id,
                c.fecha AS fecha,
                c.numero AS numero,
                c.total AS importe,
                "compra" AS tipo
            FROM compras c
            WHERE c.proveedores_id_prov = :proveedor_id
            AND c.fecha BETWEEN :fecha_inicial AND :fecha_final)
            UNION
            (SELECT
                o.id AS id,
                o.fechaop AS fecha,
                o.numero AS numero,
                SUM(o.importe) AS importe,
                "pago" AS tipo
            FROM op o
            WHERE o.proveedores_id_prov = :proveedor_id
            AND o.fechaop BETWEEN :fecha_inicial AND :fecha_final
            GROUP BY o.numero)
            ORDER BY fecha ASC'
        );
        $stmt->execute([
            ':proveedor_id' => $proveedor_id,
            ':fecha_inicial' => $fecha_inicial,
            ':fecha_final' => $fecha_final
        ]);

        $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Formatear las fechas antes de devolver los movimientos
        foreach ($movimientos as &$mov) {  // Usar referencia para modificar el array
        $mov['fecha'] = $this->formatearFecha($mov['fecha']);
        }
        return $movimientos;
    }

    public function find( $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'SELECT id, letra, suc, numero, fecha, neto, iva21, exento, total, proveedores_id_prov FROM compras WHERE ID = :id' );
        $stmt->execute( [':id'=>$id] );
        $stmt->setFetchMode( PDO::FETCH_CLASS, ComprasModel::class );
        return $stmt->fetch( );
        }
    
}
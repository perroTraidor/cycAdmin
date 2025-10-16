<?PHP

namespace App\models;


use PDO;
use App\models\EntityModel;

class ImputacionesModel extends EntityModel{
    protected $pdo;
    private int $id;
    private string $numero;
    private string $fechaop;
    private string $importe;
    private string $factura;
    private string $proveedor_nombre;
    private string $compra_id;
    private string $proveedores_id_prov;


    public function getId( ){
        return $this->id;
    }

    public function getNumero( ){
        return $this->numero;
    }
    
    public function getFecha( ){
        return $this->fechaop;
    }

    public function getFactura( ){
        return $this->factura;
    }

    public function getTotal( ){
        return $this->importe;
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

    public function all( $id ){
    $this->connect( );
    $stmt = $this->pdo->prepare(
        'SELECT
            o.id AS op_id,
            o.numero AS numero,
            o.fechaop AS fecha,
            o.importe AS total,
            o.forma AS forma,
            p.nombre AS proveedor_nombre,
            p.id AS proveedor_id
        FROM op o
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
        $this->connect( );
        $stmt = $this->pdo->prepare( 
            'INSERT INTO imputaciones_compras 
            (FECHA_IMP, IMPORTE_IMP, ID_PROVEEDOR, NRO_OP, ID_FACTURA) 
            VALUES (:fecha_imp, :importe_imp, :id_proveedor, :nro_op, :id_factura)'
        );

        $stmt->execute([
            ':fecha_imp' => $post['fecha_imp'],
            ':importe_imp' => $post['importe_imp'],
            ':id_proveedor' => $post['id_proveedor'],
            ':nro_op' => $post['nro_op'],
            ':id_factura' => $post['id_factura']
        ]);
    }

    public function createImputacion($data) {
        $this->connect( );
        $stmt = $this->pdo->prepare( 
            'INSERT INTO imputaciones_compras 
            (FECHA_IMP, IMPORTE_IMP, PROVEEDOR_ID, NRO_OP, FACTURA_ID) 
            VALUES (:fecha_imp, :importe_imp, :id_proveedor, :nro_op, :id_factura)'
        );

        $stmt->execute([
            ':fecha_imp' => $data['fecha_imp'],
            ':importe_imp' => $data['importe_imp'],
            ':id_proveedor' => $data['proveedor_id'],
            ':nro_op' => $data['nro_op'],
            ':id_factura' => $data['factura_id']
        ]);
    }

    public function createImputacionFactura($data) {

        $this->connect();  // Asegúrate de que la conexión se establece antes de usar PDO

        $query = "INSERT INTO imputaciones_compras (op_id, factura_id, monto_imputado) VALUES (:op_id, :factura_id, :monto_imputado)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':op_id', $data['op_id']);
        $stmt->bindParam(':factura_id', $data['factura_id']);
        $stmt->bindParam(':monto_imputado', $data['monto_imputado']);
        $stmt->execute();
    }
    
    public function obtenerImputacionesPorOp($numeroOp) {
        $this->connect();
        $sql = "SELECT factura_id, importe_imp FROM imputaciones_compras WHERE nro_op = :numero_op";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':numero_op' => $numeroOp]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todas las imputaciones como array asociativo
    }
}
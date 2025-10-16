<?PHP

namespace App\models;


use PDO;
use PDOException;
use App\models\EntityModel;

class OpsModel extends EntityModel{
    protected $pdo;
    private int $id;
    private string $numero;
    private string $fechaop;
    private string $importe;
    private string $forma;
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

    public function getForma( ){
        return $this->forma;
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
        $stmt = $this->pdo->prepare( 'INSERT INTO op SET FECHAOP=:fechaop, NUMERO=:numero, IMPORTE=:importe,PROVEEDORES_ID_PROV=:proveedores_id_prov' );
        $stmt->execute([':proveedores_id_prov' => $post['proveedor_id'], ':fechaop' => $post['fechaop'], ':importe' => $post['importe'], ':numero' => $post['numero'] ]);
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

    public function find( $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'SELECT id, numero, fechaop, forma, importe, proveedores_id_prov FROM op WHERE ID = :id' );
        $stmt->execute( [':id'=>$id] );
        $stmt->setFetchMode( PDO::FETCH_CLASS, OpsModel::class );
        return $stmt->fetch( );
    }

    public function findNro( $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'SELECT id, numero, fechaop, forma, importe, proveedores_id_prov FROM op WHERE numero = :numero' );
        $stmt->execute( [':numero'=>$id] );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerFacturasConSaldo($id) {
        $this->connect();
    
        try {
            // Consulta para obtener las facturas de compra del proveedor con saldo diferente de 0
            $stmt = $this->pdo->prepare(
                'SELECT id, letra, suc, numero, fecha, total, saldo 
                FROM compras 
                WHERE proveedores_id_prov = :proveedor_id 
                AND saldo != 0'
            );
            
            $stmt->execute([':proveedor_id' => $id]);
    
            // Devolver todas las facturas con saldo positivo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener las facturas con saldo: " . $e->getMessage();
            exit;
        }
    }
    

    public function createOp($data) {

        $this->connect();  // Esto asegura que $this->pdo esté inicializado

        $query = "INSERT INTO op (proveedores_id_prov, numero, fechaop, forma, importe) VALUES (:proveedor_id, :numero, :fecha, :forma, :importe)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':proveedor_id', $data['proveedor_id']);
        $stmt->bindParam(':numero', $data['numero']);
        $stmt->bindParam(':fecha', $data['fecha']);
        $stmt->bindParam(':forma', $data['forma']);
        $stmt->bindParam(':importe', $data['importe']);
        $stmt->execute();
        return $this->pdo->lastInsertId();  // Devuelve el ID de la OP recién creada
    }
        
}
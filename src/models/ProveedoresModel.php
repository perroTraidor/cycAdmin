<?PHP

namespace App\models;


use PDO;
use App\models\EntityModel;

class ProveedoresModel extends EntityModel{
    protected $pdo;
    private int $id;
    private string $nombre;
    private string $domicilio;
    private string $telefono;
    private string $cuit;
    private string $email;
    
    public function getId( ){
        return $this->id;
    }

    public function getNombre( ){
        return $this->nombre;
    }
    
    public function getDomicilio( ){
        return $this->domicilio;
    }

    public function getTelefono( ){
        return $this->telefono;
    }

    public function getCuit( ){
        return $this->cuit;
    }

    public function getEmail( ){
        return $this->email;
    }

    public function setProveedor( $nombre ){
        $this->nombre = $nombre;
    }

    // Funcion que trae todos los proveedores, cada uno como objeto de ProveedoresModel
    public function all( ){
    $this->connect( );
    $stmt = $this->pdo->prepare( 'SELECT id, nombre, domicilio, telefono, cuit, email FROM proveedores' );
    $stmt->execute( );
    $stmt->setFetchMode( PDO::FETCH_CLASS, ProveedoresModel::class );
    return $stmt->fetchAll( );
    }

    public function delete( $id ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'DELETE FROM proveedores WHERE ID = :id' );
        $stmt->execute( [ ':id' => $id ]);
    }

    public function insert( $post ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'INSERT INTO proveedores SET NOMBRE=:nombre, DOMICILIO=:domicilio, TELEFONO=:telefono, CUIT=:cuit, EMAIL=:email' );
        $stmt->execute( [ ':nombre' => $post['nombre'], ':domicilio' => $post['domicilio'], ':telefono' => $post['telefono'], ':cuit' => $post['cuit'], ':email' => $post['email'] ]);
    }

    public function update( $post ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'UPDATE proveedores SET NOMBRE=:nombre, DOMICILIO=:domicilio, TELEFONO=:telefono, EMAIL=:email WHERE ID = :id' );
        $stmt->execute( [ ':nombre' => $post['nombre'], ':domicilio' => $post['domicilio'], ':telefono' => $post['telefono'], ':email' => $post['email'], ':id' => $post['proveedor_id'], ]);
    }

    public function find( $id ){
    $this->connect( );
    $stmt = $this->pdo->prepare( 'SELECT id, nombre, domicilio, telefono, cuit, email FROM proveedores WHERE ID = :id' );
    $stmt->execute( [':id'=>$id] );
    $stmt->setFetchMode( PDO::FETCH_CLASS, ProveedoresModel::class );
    return $stmt->fetch( );
    }

    public function search($term) {
        $this->connect();
        $stmt = $this->pdo->prepare('SELECT id, nombre FROM proveedores
            WHERE nombre LIKE :term
        ');
        $stmt->execute([':term' => '%'.$term.'%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
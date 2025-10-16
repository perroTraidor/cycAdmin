<?PHP

namespace App\models;


use PDO;
use App\models\EntityModel;

class ChequesModel extends EntityModel{
    protected $pdo;

    public function insert( $post ){
        $this->connect( );
        $stmt = $this->pdo->prepare( 'INSERT INTO valores_propios SET
        BANCO=:banco,
        NUMERO=:numero,
        ID_PROVEEDOR=:id_proveedor,
        ID_OP=:id_op,
        FECHA_P=:fecha_p'
        );

        $stmt->execute([
            ':banco' => $post['banco'],
            ':numero' => $post['numero'],
            ':id_proveedor' => $post['id_proveedor'],
            ':id_op' => $post['id_op'],
            ':fecha_p' => $post['fecha_p']
        ]);
    }

    public function createCheque($data) {

        $this->connect();  // Asegúrate de que la conexión se establece antes de usar PDO
        
        $query = "INSERT INTO valores_propios (banco, numero, id_proveedor, id_op, fecha_p, importe) VALUES (:banco, :numero, :id_proveedor, :id_op, :fecha_p, :importe)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':banco', $data['banco']);
        $stmt->bindParam(':numero', $data['numero']);
        $stmt->bindParam(':id_proveedor', $data['proveedor_id']);
        $stmt->bindParam(':id_op', $data['op_id']);
        $stmt->bindParam(':fecha_p', $data['fecha_pago']);
        $stmt->bindParam(':importe', $data['importe']);
        $stmt->execute();
    }

    public function buscaCheques($formaPagoId) {
        $this->connect( );
        $stmt = $this->pdo->prepare( 'SELECT id, banco, numero, id_op, fecha_p, importe FROM valores_propios WHERE id_op = :id_op' );
        $stmt->execute( [':id_op'=>$formaPagoId] );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
        
    }
    

}

?>
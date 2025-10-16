<?php

namespace App\models;

use PDO;
use PDOException;

class EntityModel{
    protected $pdo;
    private int $id;

    public static function formatearFecha($fecha) {
        return date('d/m/Y', strtotime($fecha));
    }


    public static function formatearImporte($importe) {
        return '$' . number_format($importe, 2, ',', '.');
    }

    public function connect( ){
        if (!$this->pdo) {
        $server = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
        try {
        $this->pdo = new PDO( $server, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    }

    public function getId( ){
        return $this->id;
    }

    // Nueva función para obtener el último número de la numeración
    public function obtenerUltimoNumero($tipo, $letra, $suc) {
        try {
            // Asegurarse de que la conexión esté activa
            if (!$this->pdo) {
                $this->connect();
            }

            // Preparar la consulta SQL
            $sql = "SELECT ultimo_numero FROM numeracion WHERE tipo = :tipo AND letra = :letra AND suc = :suc";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':letra', $letra, PDO::PARAM_STR);
            $stmt->bindParam(':suc', $suc, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el resultado
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró algún resultado
            if ($resultado) {
                return $resultado['ultimo_numero'];
            } else {
                return null;  // En caso de que no se encuentre
            }

        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al obtener el último número: " . $e->getMessage();
            return null;
        }
    }

}

?>
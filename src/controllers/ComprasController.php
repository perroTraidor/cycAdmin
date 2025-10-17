<?PHP

namespace App\Controllers;

use App\models\ComprasModel;
use App\models\EntityModel;
use App\models\ProveedoresModel;
use PDOException;
use Exception;

class ComprasController{

    

    public static function list( ){
        $id = $_GET[ 'id' ];
        $cuenta = new ComprasModel( );
        $listado = $cuenta->all( $id );
        return [
            'view' => '/compras/list.php',
            'cuenta' => $listado
        ];
    }

    public static function create( ){
            $proveedoresModel = new ProveedoresModel( );
            $proveedores = $proveedoresModel->all();

            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                try{
                $compra = new ComprasModel();
                $compra->insert( $_POST );

                // Si la inserción es exitosa, puedes devolver una respuesta exitosa (JSON o mensaje)
            echo json_encode(['success' => true]);
            exit();  // Finalizar la ejecución

                header('location: /proveedores');
                exit();
                
            } catch (Exception $e) {
                // Capturar cualquier error y devolverlo como JSON
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit();

            }
        }
        
        }
    
        public static function resumenCuenta( ) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fecha_inicial = $_POST['fecha_inicial'];
            $fecha_final = $_POST['fecha_final'];
            $proveedor_id = $_POST['proveedor_id'];
        
            // Obtener el nombre del proveedor
            $proveedorModel = new ProveedoresModel();
            $proveedor = $proveedorModel->find($proveedor_id);
            $nombreProveedor = $proveedor->getNombre(); // Obtener el nombre del proveedor


            $model = new ComprasModel();
    
            // Obtener el saldo inicial
            $saldoInicial = $model->obtenerSaldoInicial($proveedor_id, $fecha_inicial);
    
            // Obtener los movimientos (compras y pagos) en el rango de fechas
            $movimientos = $model->obtenerMovimientosEnRango($proveedor_id, $fecha_inicial, $fecha_final);

            // Inicializar el objeto de formateo
            $entityModel = new EntityModel();
    
            // Calcular el saldo final
            $saldo = $saldoInicial;
            foreach ($movimientos as $key => $mov) {

                
                if ($mov['tipo'] == 'compra') {
                    $saldo += $mov['importe'];
                } elseif ($mov['tipo'] == 'pago') {
                    $saldo -= $mov['importe'];
                }
                $movimientos[$key]['saldo'] = $saldo;  // Actualizar el saldo en el array de movimientos

                
            }

            $saldoFinal = $saldo;  // El saldo final es el saldo después de todos los movimientos

// Formatear los importes y saldos antes de pasarlos a la vista
foreach ($movimientos as $key => $mov) {
    $movimientos[$key]['importe'] = $entityModel->formatearImporte($mov['importe']);
    $movimientos[$key]['saldo'] = $entityModel->formatearImporte($mov['saldo']);
}


            $f_i = new EntityModel();
                $fecha_i = $f_i->formatearFecha($fecha_inicial);
            $f_f = new EntityModel();
                $fecha_f = $f_f->formatearFecha($fecha_final);
            $s_i = new EntityModel();
                $saldo_i = $s_i->formatearImporte($saldoInicial);
            $s_f = new EntityModel();
                $saldo_f = $s_f->formatearImporte($saldoFinal);

            return [
                'view' => '/compras/resumen_cuenta.php',
                'respuesta' => [
                    'saldo_inicial' => $saldo_i,
                    'movimientos' => $movimientos,
                    'saldo_final' => $saldo_f,
                    'fecha_inicial' => $fecha_i,
                    'fecha_final' => $fecha_f,
                    'nombre_proveedor' => $nombreProveedor,
                    ],
                ];
        }
    }

    public static function obtenerDatosCompra($id) {
        $comprasModel = new ComprasModel();
        $compra = $comprasModel->find($id);
        
            if ($compra) {

            $entityModel = new EntityModel();

            $data = [
                'id' => $compra->getId(),
                'letra' => $compra->getLetra(),
                'suc' => $compra->getSuc(),
                'numero' => $compra->getNumero(),
                'fecha' => $compra->getFecha(),
                'neto' => $entityModel->formatearImporte($compra->getNeto()),
                'iva21' => $entityModel->formatearImporte($compra->getIva21()),
                'exento' => $entityModel->formatearImporte($compra->getExento()),
                'total' => $entityModel->formatearImporte($compra->getTotal()),
                'proveedores_id_prov' => $compra->getProveedorId()
            ];

                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Documento no encontrado']);
            }
            exit;
}
        
}
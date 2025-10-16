<?PHP

namespace App\Controllers;

use Exception;
use App\models\ChequesModel;
use App\models\ImputacionesModel;
use App\models\ComprasModel;
use App\models\OpsModel;
use App\models\ProveedoresModel;
use App\models\EntityModel;

class OpsController{

    private $db;
    private $chequesModel;
    private $imputacionesModel;
    private $opsModel;


    public function __construct() {
        // Instanciar los modelos
        $this->chequesModel = new ChequesModel();
        $this->imputacionesModel = new ImputacionesModel();
        $this->opsModel = new OpsModel();
    }

    
    public static function list( ){
        $id = $_GET[ 'id' ];
        $cuenta = new OpsModel( );
        $listado = $cuenta->all( $id );
        return [
            'view' => 'compras/list.php',
            'cuenta' => $listado
        ];
    }


    public static function create() {
ob_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Instanciar OpsModel que manejará la conexión
            $opModel = new OpsModel();
            
            // Inicializar una variable para sumar los subtotales
            $totalSubtotales = 0;

            // Procesar formas de pago e imputaciones
            $formasPago = json_decode($_POST['formasPagoJson'], true);
            //$imputacionesModel = new ImputacionesModel();
            
            foreach ($formasPago as $forma) {
                
                $tipo = $forma['tipo'];
                $subtotal = $forma['subtotal'];

                // Sumar el subtotal al total acumulado
                $totalSubtotales += $subtotal;
                
                // Insertar la nueva OP usando el modelo
                $opId = $opModel->createOp([
                    'proveedor_id' => $_POST['proveedor_id'],
                    'numero' => $_POST['numero'],
                    'fecha' => $_POST['fechaop'],
                    'forma' => $tipo, // Registrar la forma de pago ('efe', 'tra', 'che', etc.)
                    'importe' => $subtotal // Registrar el subtotal de cada forma de pago
                ]);
            
                // Si es cheque o echeq, registrar los detalles
                if ($tipo === 'che' || $tipo === 'ech') {
                    $chequesModel = new ChequesModel();
                    foreach ($forma['cheques'] as $cheque) {
                        $chequesModel->createCheque([
                            'proveedor_id' => $_POST['proveedor_id'],
                            'op_id' => $opId,
                            'banco' => $cheque['banco'],
                            'fecha_pago' => $cheque['fecha_pago'],
                            'numero' => $cheque['numero'],
                            'importe' => $cheque['importe']
                        ]);
                    }
                }
            }

            // Verificar si el total de los subtotales coincide con el grandTotalOp
        $grandTotalOp = $_POST['grandTotalOp'];
        if ($totalSubtotales != $grandTotalOp) {
            // Si no coincide, puedes manejar el error como prefieras (ejemplo: lanzar una excepción o mostrar un mensaje)
            $_SESSION['error'] = "Los subtotales no coinciden con el total de la OP.";
header('Location: /index.php?entidad=proveedores');
            exit;
        }

        // Instanciar el ImputacionesModel para registrar las imputaciones
        $imputacionesModel = new ImputacionesModel();

        // Procesar las facturas imputadas desde los inputs hidden
        if (isset($_POST['facturas'])) {
            foreach ($_POST['facturas'] as $factura) {
                $imputacionesModel->createImputacion([
                    'fecha_imp' => $_POST['fechaop'],  // ID de la factura
                    'importe_imp' => $factura['monto'],  // Monto a imputar
                    'nro_op' => $_POST['numero'],  // NRO de la OP creada
                    'proveedor_id' => $_POST['proveedor_id'],
                    'factura_id' => $factura['id'],  // ID de la factura
                ]);
            }
        }

        // Obtener facturas con saldo pendiente para el proveedor
        $facturasConSaldo = $opModel->obtenerFacturasConSaldo($_POST['proveedor_id']);
        
        if ($facturasConSaldo) {
            // Mostrar el modal con las facturas
            header('Content-Type: application/json');
            echo json_encode([
                'facturas' => $facturasConSaldo,
                'grandTotalOp' => $grandTotalOp  // Enviar el total para hacer las imputaciones
            ]);
        } else {
$_SESSION['error'] = "No se encontraron facturas con saldo pendiente.";
ob_end_clean();
header('Location: /index.php?entidad=proveedores');
            exit;
        }
ob_end_clean();
            // Redirigir a la página de éxito
            header('Location: /index.php?entidad=proveedores');
            exit;
        }

        
    }
    
    public static function obtenerDatosOp($id) {
        $opsModel = new OpsModel();
        $op = $opsModel->findNro($id);

                
            if ($op) {

                $total = 0; // Initialize total variable
                $data = [];
                $formasPago = []; // Store payment methods and their subtotals
        
                    foreach ($op as $op) {
                    $formasPago[] = [
                        'forma' => $op['forma'],
                        'importe' => $op['importe'],
                        'id' => $op['id']
                    ];

                $total += $op['importe']; // Sum the total for all payments
                }

                        // Obtener las imputaciones a las facturas
                $imputacionesModel = new ImputacionesModel();
                $imputaciones = $imputacionesModel->obtenerImputacionesPorOp($op['numero']);
                
                $comprasModel = new ComprasModel();
                $facturas = [];

                // Recorrer cada imputación para obtener los datos de las facturas
                foreach ($imputaciones as $imputacion) {
                    $factura = $comprasModel->find($imputacion['factura_id']);
                    
                    // Agregar detalles de la factura y el monto imputado
                    $facturas[] = [
                        'numero_factura' => $factura->getNumero(),
                        'fecha_factura' => $factura->getFecha(),
                        'importe_imputado' => $imputacion['importe_imp']
                    ];
                }

            $data = [
                'id' => $op['id'],
                'numero' => $op['numero'],
                'fechaop' => $op['fechaop'],
                'proveedores_id_prov' => $op['proveedores_id_prov'],
                'formas_pago' => $formasPago,
                'total' => $total, // Total of all forms of payment
                'imputaciones' => $facturas // Facturas imputadas con sus detalles
                
            ];

                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Orden de pago no encontrado']);
            }
            exit;
}

    
    // Nuevo método para obtener el último número
    public static function obtenerUltimoNumero() {
        // Crear una instancia del modelo
        $entityModel = new EntityModel();
        
        // Llamar al método obtenerUltimoNumero con los parámetros deseados
        $tipo = 'pago';  // Tipo de documento, puedes cambiarlo según sea necesario
        $letra = '0';  // Letra, también puedes cambiarla o recibirla dinámicamente
        $suc = '1';  // Sucursal, lo mismo aplica aquí

        // Obtener el último número
        $ultimoNumero = $entityModel->obtenerUltimoNumero($tipo, $letra, $suc);
        
        // Verificar si se obtuvo un resultado válido
        if ($ultimoNumero !== null) {
            // Devolver el último número en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['ultimo_numero' => $ultimoNumero]);
        } else {
            // En caso de error, devolver un mensaje de error
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No se pudo obtener el último número.']);
        }
        exit;
    }

    public static function obtenerFacturasConSaldo() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $proveedorId = $_GET['id'];
            
            $opModel = new OpsModel();
            
            // Obtener las facturas del proveedor con saldo pendiente
            $facturas = $opModel->obtenerFacturasConSaldo($proveedorId);
            
            if ($facturas) {
                header('Content-Type: application/json');
                echo json_encode($facturas);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se encontraron facturas con saldo pendiente.']);
            }
        } else {
            echo json_encode(['error' => 'Parámetro proveedor_id faltante o incorrecto.']);
        }
        exit;
    }
    

}
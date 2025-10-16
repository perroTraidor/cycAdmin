<?PHP

namespace App\Controllers;

use App\models\ProveedoresModel;

class ProveedoresController{
    
    public static function list( ){
        $proveedor = new ProveedoresModel( );
        $listado = $proveedor->all( );
        return [
            'view' => 'proveedores/list.php',
            'proveedores' => $listado
        ];
    }

    public static function create( ){
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $proveedor = new ProveedoresModel( );
            $proveedor->insert( $_POST );
            header('location: /proveedores');
            die( );
        }
        return [
            'view' => 'proveedores/edit.php',
            'form' => [
                'title' => 'Alta Proveedor',
                'button' => 'Agregar Proveedor',
                'action' => '/proveedores/create'
            ]
        ];
    }
    public static function view( ){
        $id = $_GET[ 'id' ];
        $proveedor = new ProveedoresModel( );
        $actual = $proveedor->find( $id );
        
        return [
            'view' => 'proveedores/view.php',
            'form' => [
                // 'title' => 'Datos Proveedor',
                // 'button' => 'Guardar Cambios',
                'action' => '/proveedores/'.$id.'/view',
                'values' => $actual
            ]
        ];
    }
        
    public static function obtenerDatosProveedor($id) {
        $proveedorModel = new ProveedoresModel();
        $proveedor = $proveedorModel->find($id);
                
            if ($proveedor) {

            $data = [
                'id' => $proveedor->getId(),
                'nombre' => $proveedor->getNombre(),
                'domicilio' => $proveedor->getDomicilio(),
                'telefono' => $proveedor->getTelefono(),
                'cuit' => $proveedor->getCuit(),
                'email' => $proveedor->getEmail()
            ];

                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Proveedor no encontrado']);
            }
        exit;
}

    public static function search() {
        $query = $_GET['term'] ?? '';

        $proveedoresModel = new ProveedoresModel();
        $proveedores = $proveedoresModel->search($query);

        // Devolver los resultados como JSON
        header('Content-Type: application/json');
        echo json_encode($proveedores);
        exit;
    }

    public static function proveedorData($id) {
        $proveedorModel = new ProveedoresModel();
        $proveedor = $proveedorModel->find($id);
    
        if ($proveedor) {
            $data = [
                'id' => $proveedor->getId(),
                'nombre' => $proveedor->getNombre(),
                'domicilio' => $proveedor->getDomicilio(),
                'telefono' => $proveedor->getTelefono(),
                'cuit' => $proveedor->getCuit(),
                'email' => $proveedor->getEmail()
            ];

            return $data;
        } else {
            return null;
        }
    }

    public static function delete( ){
        $id = $_GET['id'];
        $proveedor = new ProveedoresModel( );
        $proveedor->delete( $id );
        header('location: /proveedores');
    }

    public static function edit( ){
        $id = $_GET[ 'id' ];
        $proveedor = new ProveedoresModel( );
        $actual = $proveedor->find( $id );

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        $proveedor = new ProveedoresModel( );
        $proveedor->update( $_POST );
        header('Location: /proveedores');
        die( );
    }
        return [
            'view' => 'proveedores/edit.php',
            'form' => [
                'title' => 'Modificar Proveedor',
                'button' => 'Guardar Cambios',
                'action' => '/proveedores/'.$id.'/edit',
                'values' => $actual
            ]
        ];
    }

}
<?PHP

namespace App\Controllers;

use App\models\ImputacionesModel;
use App\models\ComprasModel;
use App\models\OpsModel;
use App\models\ProveedoresModel;
use App\models\EntityModel;

class ImputacionesController{
    public static function create( ){
            
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            $imputacion = new ImputacionesModel();
            $imputacion->insert( $_POST );
            
            // Redirige a la página de proveedores después de insertar.
            header('location: /proveedores');
            die();
            }

        // Retorna vista de creación de imputaciones.
        return [
            'view' => 'imputaciones/create.php',
            'form' => [
                'action' => '/imputaciones/create',
                ]
            ];
        }
}
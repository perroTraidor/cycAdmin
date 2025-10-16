<?PHP

namespace App\Controllers;
class ClientesController{

    public static function list( ){
        return [
            'view' => 'clientes/list.php'
        ];
    }

    public static function create( ){
        return [
            'view' => 'clientes/edit.php',
            'form' => [
                'title' => 'Alta Cliente',
                'button' => 'Agregar cliente'
            ]
        ];
    }

    public static function view( ){
        return [
            'view' => 'clientes/edit.php'
        ];
    }

    public static function delete( ){
        echo "Borrando cliente";
    }

    public static function edit( ){
        return [
            'view' => 'clientes/edit.php',
            'form' => [
                'title' => 'Modificar Cliente',
                'button' => 'Guardar Cambios'
            ]
        ];;
    }


}
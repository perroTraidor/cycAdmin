<?php
namespace App\Controllers;

use App\models\UserModel;

class DashboardController {
    public static function dashboard() {
        return ['view' => '/dashboard.php'];
    }

    public static function comprasdash() {
        return ['view' => '/compras/dash.php'];
    }

    public static function ventasdash() {
        return ['view' => '/ventas/dash.php'];
    }

    public static function cajadash() {
        return ['view' => '/caja/dash.php'];
    }

    public static function cotizadash() {
        return ['view' => '/cotizaciones/dash.php'];
    }
}


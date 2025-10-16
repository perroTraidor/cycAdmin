<?php
// config/config.php - Configuración portable

// Detectar entorno automáticamente
$isLocal = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']) || 
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;

// Configuración según entorno
if ($isLocal) {
    // ========== DESARROLLO LOCAL (XAMPP) ==========
    define('ENV', 'dev');
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'cycadmin_gestion');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    
    // Detectar automáticamente la carpeta del proyecto
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $baseDir = dirname($scriptName);
    //define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $baseDir);
    
} else {
    // ========== PRODUCCIÓN (SERVIDOR) ==========
    define('ENV', 'prod');
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'cycadmin'); // Cambiar por tu BD de producción
    define('DB_USER', 'root');     // Cambiar por tu usuario de producción
    define('DB_PASS', '');         // Cambiar por tu password de producción
    
    // En producción, ajusta esto a tu dominio
    define('BASE_URL', 'https://tudominio.com');
}

// Constantes comunes
define('DB_CHARSET', 'utf8mb4');
//define('ROOT_DIR', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);

// Configuración de errores según entorno
if (ENV === 'dev') {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT_DIR . 'logs/php-errors.log');
}

// Zona horaria
date_default_timezone_set('America/Argentina/Cordoba');
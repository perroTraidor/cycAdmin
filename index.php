<?php

// Definir constantes de rutas
define('ROOT_DIR', __DIR__ . '/');
define('SRC_DIR', ROOT_DIR . 'src/');
define('LIBS_DIR', ROOT_DIR . 'libs/');
define('CONFIG_DIR', ROOT_DIR . 'config/');
define('BASE_URL', '/cycAdmin/');

// Cargar configuración principal (solo UNA vez)
require_once __DIR__ . '/config/config.php';

// Cargar configuración de utilidades (define VIEWS, MODELS, CONTROLLERS, etc.)
require_once ROOT_DIR . 'src/utils/config.php';

// Cargar bootstrap si existe
if (file_exists(ROOT_DIR . 'src/bootstrap.php')) {
    require_once ROOT_DIR . 'src/bootstrap.php';
}

// Cargar autoload (DESPUÉS de tener las constantes definidas)
require_once ROOT_DIR . 'src/utils/autoload.php';

// Obtener parámetros de la URL
$entidad = $_GET['entidad'] ?? 'proveedores';
$entidad = ucfirst(strtolower($entidad));
$accion = $_GET['accion'] ?? 'list';
$id = $_GET['id'] ?? null;

// Construir el nombre de la clase del controlador
$clase = 'App\\Controllers\\' . $entidad . 'Controller';

// Validar que la clase existe
if (!class_exists($clase)) {
    if (ENV === 'dev') {
        die('Error: No existe la clase ' . $clase);
    } else {
        http_response_code(404);
        die('Página no encontrada');
    }
}

// Validar que el método existe
if (!method_exists($clase, $accion)) {
    if (ENV === 'dev') {
        die('Error: No existe el método ' . $accion . ' en ' . $clase);
    } else {
        http_response_code(404);
        die('Página no encontrada');
    }
}

// Llamar al método del controlador con o sin ID
if ($id) {
    $respuesta = $clase::$accion($id);
} else {
    $respuesta = $clase::$accion();
}

// Iniciar buffer de salida
ob_start();

// Obtener el archivo de vista
$archivo = $respuesta['view'] ?? 'error.php';

// Incluir header si no es login
if ($archivo !== 'login.php' && $archivo !== '/login.php') {
    include(ROOT_DIR . 'src/views/inc/header.php');
}

// Extraer variables de la respuesta para la vista
if (isset($respuesta['respuesta'])) {
    extract($respuesta['respuesta']);
}

// Incluir la vista principal
$vistaPath = ROOT_DIR . 'src/views' . $archivo;
if (file_exists($vistaPath)) {
    include($vistaPath);
} else {
    if (ENV === 'dev') {
        die('Error: No se encuentra la vista ' . $vistaPath);
    } else {
        die('Error al cargar la página');
    }
}

// Incluir footer si no es login
if ($archivo !== 'login.php' && $archivo !== '/login.php') {
    include(ROOT_DIR . 'src/views/inc/footer.php');
}

// Enviar el buffer
ob_end_flush();
?>
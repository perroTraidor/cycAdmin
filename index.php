<?php

include('src/utils/config.php');
include('src/utils/autoload.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$entidad = $_GET['entidad'] ?? 'proveedores';
$entidad = ucfirst(strtolower($entidad));
$accion = $_GET['accion'] ?? 'list';

$clase = 'App\\Controllers\\'.$entidad.'Controller';

if( !class_exists( $clase )) {
    die('No existe la clase ' . $clase);
}

if( !method_exists($clase, $accion)) {
    die('No existe el método ' . $accion);
}

// Capturar el parámetro id si está presente en la URL
$id = $_GET['id'] ?? null;

// Llamar al método con o sin parámetros, dependiendo de si el id está presente
if ($id) {
    // Si hay un id en la URL, pasar el id como parámetro al método
    $respuesta = $clase::$accion($id);
} else {
    // Si no hay id, llamar al método sin parámetros
    $respuesta = $clase::$accion();
}
ob_start();
// Procesar la vista
$archivo = $respuesta['view'];

if ($archivo !== 'login.php') {
    include(VIEWS . '/inc/header.php');
}

// Extraer variables de la respuesta para hacerlas disponibles en la vista
if (isset($respuesta['respuesta'])) {
    extract($respuesta['respuesta']);
}

include(VIEWS . '/' . $archivo);

if ($archivo !== 'login.php') {
    include(VIEWS . '/inc/footer.php');
}
ob_end_flush();
?>
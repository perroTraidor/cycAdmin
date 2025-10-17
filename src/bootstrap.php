<?php
// src/bootstrap.php

if (!defined('ROOT_DIR')) {
    define('ROOT_DIR', realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR);
}

// Registrar autoload de clases
spl_autoload_register(function ($class) {
    $file = ROOT_DIR . 'src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Incluir librerías externas
//if (file_exists(LIBS_DIR. 'fpdf/fpdf.php')) {
//    require_once LIBS_DIR. 'fpdf/fpdf.php';
//}

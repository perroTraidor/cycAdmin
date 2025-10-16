<?php
// src/utils/config.php
// Este archivo ahora solo define constantes auxiliares
// La configuración principal está en config/config.php

// Definir rutas de directorios
define('VIEWS', ROOT_DIR . 'src/views');
define('MODELS', ROOT_DIR . 'src/models');
define('CONTROLLERS', ROOT_DIR . 'src/controllers');

// Conexión a la base de datos
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    if (ENV === 'dev') {
        die('Error de conexión a la base de datos: ' . $e->getMessage());
    } else {
        error_log('DB Connection Error: ' . $e->getMessage());
        die('Error de conexión al sistema. Contacte al administrador.');
    }
}

// Funciones helper
function base_url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

function asset_url($path = '') {
    return BASE_URL . '/assets/' . ltrim($path, '/');
}
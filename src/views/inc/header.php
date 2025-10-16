<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: /login");
    exit();
}?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Compras</title>
    <link rel="icon" type="image/vnd.icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/estilos.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">


<script src="assets/js/scripts.js"></script>


</head>
<body>

    <header class="d-flex justify-content-between align-items-center px-4 py-3">
        <div>
            <img src="assets/img/logo.png" width="80px">
        </div>
        <div>
            <?php include( __DIR__ . '/nav.php') ; ?>
        </div>
        <div class="dropdown" style="margin-left: 2em;">
            <!-- Avatar -->
            <img src="<?php echo !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/img/generic_avatar.png'; ?>" width="25" alt="" class="avatar" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Menu Dropdown -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="#">Ajustes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
            </ul>
        </div>
    </header>
    <main> <!-- Sigue el main -->
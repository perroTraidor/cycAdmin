<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Compras</title>
    <!-- <link rel="stylesheet" href="/assets/css/estilos.css"> -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col text-center">
                <img src="/assets/img/logo.png" class="rounded" style="height: 70px; margin-bottom: 5%;" alt="">
                <form action="/index.php?entidad=auth&accion=login" method="post">
                <div class="form-floating mb-3 mt-5 text-center" style="margin: 0 auto;" >
                <input type="text" class="form-control-sm" id="username" name="username" placeholder="Usuario" style="border-radius: 10px;">
            </div>
            <div class="form-floating text-center" style="margin: 0 auto;">
                <input type="password" class="form-control-sm" id="password" name="password" placeholder="Contraseña" style="border-radius: 10px;">
            </div>
                <button type="submit" class="btn btn-secondary btn-sm" style="margin-top: 20px; border-radius: 10px; margin-bottom: 30px;">Ingresar</button>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarme</button>
                <div class="form-check">
                <input class="form-check-input checkbox-sm" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                Recordarme
                </label>
            </div>
        </form>
    </div>
</div>
    </div>

    <!-- Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="loginToast" class="toast align-items-center text-bg-secondary border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toast-body-message">
                    <!-- Mensaje de error se mostrará aquí -->
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if (error) {
                const toastMessage = document.getElementById('toast-body-message');
                if (error === 'empty_fields') {
                    toastMessage.textContent = 'Usuario o contraseña no pueden estar vacíos';
                } else if (error === 'invalid_credentials') {
                    toastMessage.textContent = 'Usuario o contraseña incorrectos';
                }
                const toastElement = new bootstrap.Toast(document.getElementById('loginToast'));
                toastElement.show();
            }
        });
    </script>

    <!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">

        <div>
<form action="/auth/register" method="POST" enctype="multipart/form-data">
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="avatar">Avatar</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
    </div>
    <button type="submit">Register</button>
</form>
</div>

        
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


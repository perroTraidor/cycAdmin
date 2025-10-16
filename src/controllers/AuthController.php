<?php
namespace App\Controllers;

use App\models\UserModel;

class AuthController {
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                // Redirigir al login con un mensaje de error si los campos están vacíos
                header('Location: /login?error=empty_fields');
                exit;
            }

            $userModel = new UserModel();
            $user = $userModel->findUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['avatar'] = $user['avatar'];
                header('Location: /dashboard');  // Redirige a la vista correspondiente
            } else {
                // Manejar errores de autenticación
                header('Location: /login?error=invalid_credentials');
                exit;
            }
        } else {
            return ['view' => '/login.php'];
        }
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
    }

    // Hasta acá funciona - Lo que sigue es el registro y validacion

    public static function register() {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Verifica si se subió un archivo
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatarPath = self::uploadAvatar($_FILES['avatar']);
        } else {
            $avatarPath = 'assets/img/generic_avatar.png'; // Ruta a un avatar por defecto
        }

        $user = new UserModel();
        $user->create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'avatar' => $avatarPath
        ]);

        // Envía email de confirmación
        self::sendEmailConfirmation($email);

        // Redirigir al login
        header('Location: /login');
    }

    // Subida del avatar
    private static function uploadAvatar($file) {
        $uploadDir = 'assets/uploads/';
        $fileName = time() . '_' . basename($file['name']);
        $uploadFile = $uploadDir . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $uploadFile;
        } else {
            throw new \Exception('Error al subir el archivo');
        }
    }

    // Enviar email de confirmación
    private static function sendEmailConfirmation($email) {
        $token = bin2hex(random_bytes(16)); // Generar token de confirmación
        $confirmLink = "http://yourdomain.com/auth/confirm?token=" . $token;

        // Guarda el token en la base de datos asociado al usuario

        // Enviar el email
        $subject = "Confirma tu registro";
        $message = "Por favor confirma tu cuenta haciendo click en el siguiente enlace: " . $confirmLink;
        mail($email, $subject, $message);
    }

    // Verificación de email
    public static function confirmEmail() {
        $token = $_GET['token'];
        
        // Verifica el token y activa la cuenta en la base de datos
        
        header('Location: /login');
    }

    public static function sendPasswordReset($email) {
        $token = bin2hex(random_bytes(16)); // Generar un token único
        $resetLink = "http://yourdomain.com/auth/resetPassword?token=" . $token;
    
        // Guarda el token en la base de datos
        $user = new UserModel();
        $user->savePasswordResetToken($email, $token);
    
        // Enviar el email con el enlace de recuperación
        $subject = "Recuperación de contraseña";
        $message = "Haz click en este enlace para restablecer tu contraseña: " . $resetLink;
        mail($email, $subject, $message);
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $newPassword = $_POST['new_password'];
            $token = $_POST['token']; // El token que has enviado por email
    
            // Valida que el token es correcto
            $userModel = new UserModel();
            $user = $userModel->getUserByToken($token);
    
            if ($user) {
                // Hashear la nueva contraseña
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
                // Actualiza la contraseña en la base de datos
                $userModel->updatePassword($user['id'], $hashedPassword);
    
                // Borra el token o invalídalo después de cambiar la contraseña
                $userModel->invalidateToken($user['id']);
    
                echo "Contraseña actualizada correctamente.";
            } else {
                echo "Token inválido o expirado.";
            }
        }
    }
}
?>
<?php

// src/models/UserModel.php

namespace App\Models;

use PDO;

class UserModel {
    private $pdo;

    public function connect( ){
        $server = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
        $this->pdo = new PDO( $server, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Asegúrate de capturar errores en PDO
    }

    public function findUserByUsername($username) {
        $this->connect( );
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

// Hasta acá funciona - Lo que sigue es el registro



    public function create($data) {
        $this->connect( );
        $stmt = $this->pdo->prepare('INSERT INTO usuarios (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)');
        $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':avatar' => $data['avatar']
        ]);
    }

    // Guardar token de recuperación de contraseña
    public function savePasswordResetToken($email, $token) {
        $sql = "UPDATE usuarios SET reset_token = :token WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':token' => $token, ':email' => $email]);
    }


    // Función para obtener el usuario por el token de recuperación
    public function getUserByToken($token) {
        $sql = "SELECT * FROM usuarios WHERE reset_token = :token LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Función para actualizar la contraseña
    public function updatePassword($userId, $hashedPassword) {
        $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    // Invalida el token una vez usada la recuperación
    public function invalidateToken($userId) {
        $sql = "UPDATE usuarios SET reset_token = NULL WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    

}

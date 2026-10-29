<?php

require_once __DIR__ . '/../../config/database.php';

class AuthController
{
    public function login()
    {
        global $pdo;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $stmt = $pdo->prepare(
                "SELECT * FROM users WHERE username = :username"
            );

            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header('Location: /');
                exit;
            }

            $error = 'Username atau password salah.';
        }

        require __DIR__ . '/../../views/pages/auth/login.php';
    }
}
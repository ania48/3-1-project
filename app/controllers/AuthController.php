<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function login()
    {
        require __DIR__ . '/../views/login.php';
    }

    public function loginSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $name = $_POST['name'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByName($name);

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                header("Location: index.php?controller=dashboard&action=index");
                exit;
            } else {
                $error = "Invalid username or password.";
                require __DIR__ . '/../views/login.php';
            }
        }
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once __DIR__ . '/../models/User.php';

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                $error = 'All fields are required.';
            } else {
                $userModel = new User();
                if ($userModel->userExists($name)) {
                    $error = 'Username already exists.';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $userModel->createUser($name, $email, $hashedPassword, $role);
                    $success = 'Registration successful. You may log in now.';
                }
            }
        }

        require_once __DIR__ . '/../views/register.php';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}

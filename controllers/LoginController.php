<?php
require_once 'models/Admin.php';

class LoginController
{
    private $adminModel;

    public function __construct($db)
    {
        $this->adminModel = new Login($db);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($admin = $this->adminModel->login($username, $password)) {
                $_SESSION['user_id'] = $admin->id;
                $_SESSION['username'] = $admin->username;
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            } else {
                $message = "Username atau password salah.";
                $message_type = 'danger';
            }
        }
        include 'views/login/index.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

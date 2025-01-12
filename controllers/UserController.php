<?php
require_once 'models/User.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function index()
    {
        $users = $this->userModel->getAll();
        include 'views/user/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $bio = $_POST['bio'];
            $picture = $_FILES['picture'];
            $error = $this->userModel->add($username, $email, $password, $name, $bio, $picture);
            if (!$error) {
                $_SESSION['message'] = 'User berhasil ditambahkan';
                header('Location: ' . BASE_URL . '/users');
                exit;
            } else {
                $message = $error;
                $message_type = 'danger';
            }
        }
        $action = 'add';
        include 'views/user/form.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $bio = $_POST['bio'];
            $picture = $_FILES['picture'];
            $error = $this->userModel->update($id, $username, $email, $password, $name, $bio, $picture);
            if (!$error) {
                $_SESSION['message'] = 'User berhasil diperbarui';
                header('Location: ' . BASE_URL . '/users');
                exit;
            } else {
                $message = "Gagal memperbarui user.";
                $message_type = 'danger';
            }
        }
        $user = $this->userModel->getById($id);
        $action = 'edit';
        include 'views/user/form.php';
    }

    public function delete($id)
    {
        if ($this->userModel->delete($id)) {
            $_SESSION['message'] = 'User berhasil dihapus';
        } else {
            $_SESSION['message'] = 'Gagal menghapus user';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: ' . BASE_URL . '/users');
        exit;
    }
}

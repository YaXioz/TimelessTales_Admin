<?php
class Login
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->initializeDatabase('Admin', 'id');
    }

    public function login($username, $password)
    {
        // $stmt = $this->conn->prepare("SELECT `id`, `username`, `password` FROM `admin` WHERE `username` = ?");
        // $stmt->bind_param("s", $username);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // if ($user = $result->fetch_assoc()) {
        //     if (password_verify($password, $user['password'])) {
        //         return $user;
        //     }
        // }
        $result = $this->conn->findBy('username', $username)->getFirstResult();
        if ($result) {
            if (password_verify($password, $result->password)) {
                return $result;
            }
        }

        return false;
    }
}

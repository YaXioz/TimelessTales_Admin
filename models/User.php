<?php

use Supabase\Storage\StorageClient;
use Ramsey\Uuid\Uuid;
use Supabase\Storage\StorageFile;

require 'vendor/autoload.php';




class User
{
    private $storage;
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->initializeDatabase('Users', 'id');
        $this->storage = new StorageFile(SUPABASE_KEY, STORAGE_ID, 'cilukba');
    }

    public function getAll()
    {
        // $query = "SELECT * FROM user";
        // $result = $this->conn->query($query);
        // return $result->fetch_all(MYSQLI_ASSOC);
        // var_dump($this->conn->fetchAll()->getResult());
        $result = $this->conn->fetchAll()->getResult();
        sort($result);
        return $result;
    }

    public function getById($id)
    {
        // $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = ?");
        // $stmt->bind_param("i", $id);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // return $result->fetch_assoc();
        $result = $this->conn->findBy('id', $id)->getFirstResult();
        return $result;
    }

    public function add($username, $email, $password, $name, $bio, $picture)
    {
        // $stmt = $this->conn->prepare("INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)");
        // $stmt->bind_param("ssi", $title, $author, $published_year);
        // return $stmt->execute() ? $stmt->insert_id : false;

        $error = [];
        $checkU = $this->conn->findBy('username', $username)->getFirstResult();
        $checkE = $this->conn->findBy('email', $email)->getFirstResult();
        if (strlen($username) == 0) {
            $error['username'] = 'Username harus diisi';
        } else if (isset($checkU->username)) {
            $error['username'] = 'Username telah terdaftar';
        }
        if (strlen($email) == 0) {
            $error['email'] = 'Email harus diisi';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Masukkan email yang valid";
        } else if (isset($checkE->email)) {
            $error['email'] = 'Email telah terdaftar';
        }
        if (strlen($password) <= 8) {
            $error['password'] = 'Password harus memiliki minimal 8 karakter';
        } else if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $error['password'] = 'Password harus terdiri dari huruf, angka, dan spesial karakter.';
        }
        if ($picture['error'] !== 4) {
            if (!exif_imagetype($picture['tmp_name'])) {
                $error['picture'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path = $uuid->toString() . "." . pathinfo($picture['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path, $picture['tmp_name'], ['public' => true]);
                $output = json_decode($r->getBody(), true);
            }
        }
        if (count($error) > 0) {
            return $error;
        }

        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);


        $result = $this->conn->insert([
            "username" => $username,
            "email" => $email,
            "password" => $hashedPassword,
            "name" => $name,
            "bio" => $bio,
            "picture" => isset($path) ? $path : null
        ]);
        if ($result) return false;

        $error["server"] = 'Terdapat gangguan, data gagal ditambahkan. Mohon coba lagi.';
        return $error;
    }

    public function update($id, $username, $email, $password, $name, $bio, $picture)
    {
        // $stmt = $this->conn->prepare("UPDATE books SET title = ?, author = ?, published_year = ? WHERE id = ?");
        // $stmt->bind_param("ssii", $title, $author, $published_year, $id);
        // return $stmt->execute();
        // $this->storage->

        $old = $this->getById($id);

        $error = [];


        if (strlen($username) == 0) {
            $error['username'] = 'Username harus diisi';
        }
        if ($username != $old->username) {
            $checkU = $this->conn->findBy('username', $username)->getFirstResult();
            if (isset($checkU->username)) {
                $error['username'] = 'Username telah terdaftar';
            }
        }
        if (strlen($email) == 0) {
            $error['email'] = 'Email harus diisi';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Masukkan email yang valid";
        }
        if ($email != $old->email) {
            $checkE = $this->conn->findBy('email', $email)->getFirstResult();
            if (isset($checkE->email)) {
                $error['email'] = 'Email telah terdaftar';
            }
        }
        if ($password != null) {
            if (strlen($password) <= 8) {
                $error['password'] = 'Password harus memiliki minimal 8 karakter';
            } else if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                $error['password'] = 'Password harus terdiri dari huruf, angka, dan spesial karakter.';
            }
        }
        if ($picture['error'] !== 4) {
            if (!exif_imagetype($picture['tmp_name'])) {
                $error['picture'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path = $uuid->toString() . "." . pathinfo($picture['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path, $picture['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if (count($error) > 0) {
            return $error;
        }

        if ($password != null) {
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
        }


        $result = $this->conn->update($id, [
            "username" => $username,
            "email" => $email,
            "password" => isset($hashedPassword) ? $hashedPassword : $old->password,
            "name" => $name,
            "bio" => $bio,
            "picture" => isset($path) ? $path : $old->picture
        ]);
        if ($result) {
            $this->storage->remove([$old->picture]);
            return false;
        }

        $error["server"] = 'Terdapat gangguan, data gagal diubah. Mohon coba lagi.';
        return $error;
    }

    public function delete($id)
    {
        // $stmt = $this->conn->prepare("DELETE FROM books WHERE id = ?");
        // $stmt->bind_param("i", $id);
        // return $stmt->execute();
        $old = $this->getById($id);
        $picture = $old->picture;
        if ($this->storage->remove($picture)) {
            if ($this->conn->delete($id)) {
                return true;
            }
        }
        return false;
    }
}

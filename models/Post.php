<?php

use Supabase\Storage\StorageClient;
use Ramsey\Uuid\Uuid;
use Supabase\Storage\StorageFile;

require 'vendor/autoload.php';




class Post
{
    private $storage;
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->initializeDatabase('Posts', 'id');
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

    public function add($timeline_id, $image, $description, $event_date)
    {
        // $stmt = $this->conn->prepare("INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)");
        // $stmt->bind_param("ssi", $title, $author, $published_year);
        // return $stmt->execute() ? $stmt->insert_id : false;
        $error = [];





        if ($image['error'] !== 4) {
            if (!exif_imagetype($image['tmp_name'])) {
                $error['image_1'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path = $uuid->toString() . "." . pathinfo($image['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path, $image['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }


        if (count($error) > 0) {
            return $error;
        }
        // Mendapatkan timestamp saat ini dengan mikrodetik
        $micro_date = microtime(true);

        // Memformat tanggal dan waktu
        $date_format = date("Y-m-d H:i:s", $micro_date);

        // Mendapatkan mikrodetik dan memformat menjadi 3 digit
        $micro_seconds = sprintf(".%03d", ($micro_date - floor($micro_date)) * 1000);

        // Menggabungkan tanggal yang diformat dengan mikrodetik
        $formatted_date = $date_format . $micro_seconds;

        $result = $this->conn->insert([
            "timeline_id" => $timeline_id,
            "url" => Uuid::uuid4(),
            "image" => isset($path) ? $path : null,
            "description" => $description,
            "event_date" => $event_date,
            "created_at" => $formatted_date
        ]);
        if ($result) return false;

        $error["server"] = 'Terdapat gangguan, data gagal ditambahkan. Mohon coba lagi.';
        return $error;
    }

    public function update($id, $timeline_id, $image, $description, $event_date)
    {
        // $stmt = $this->conn->prepare("UPDATE books SET title = ?, author = ?, published_year = ? WHERE id = ?");
        // $stmt->bind_param("ssii", $title, $author, $published_year, $id);
        // return $stmt->execute();
        // $this->storage->

        $old = $this->getById($id);

        $error = [];


        if ($image['error'] !== 4) {
            if (!exif_imagetype($image['tmp_name'])) {
                $error['image_1'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path = $uuid->toString() . "." . pathinfo($image['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path, $image['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }

        if (count($error) > 0) {
            return $error;
        }


        $result = $this->conn->update($id, [
            "timeline_id" => $timeline_id,
            "url" => Uuid::uuid4(),
            "image" => isset($path) ? $path : $old->image,
            "description" => $description,
            "event_date" => $event_date,
        ]);
        if ($result) {
            $this->storage->remove([$old->image]);
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
        $image = $old->image;
        if ($this->storage->remove($image)) {
            if ($this->conn->delete($id)) {
                return true;
            }
        }
        return false;
    }
}

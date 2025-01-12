<?php

use Supabase\Storage\StorageClient;
use Ramsey\Uuid\Uuid;
use Supabase\Storage\StorageFile;

require 'vendor/autoload.php';




class Timeline
{
    private $storage;
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->initializeDatabase('Timelines', 'id');
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

    public function add($user_id, $year, $image_1, $image_2, $image_3)
    {
        // $stmt = $this->conn->prepare("INSERT INTO books (title, author, published_year) VALUES (?, ?, ?)");
        // $stmt->bind_param("ssi", $title, $author, $published_year);
        // return $stmt->execute() ? $stmt->insert_id : false;
        $error = [];


        $timelines = $this->conn->findBy('user_id', $user_id);
        $checkY = false;
        foreach ($timelines as $timeline) {
            if ($timeline->year == $year) {
                $checkY = true;
            }
        }

        if ($checkY) {
            return $error['year'] = 'Tahun telah memiliki timeline, pilih tahun lain.';
        }


        if ($image_1['error'] !== 4) {
            if (!exif_imagetype($image_1['tmp_name'])) {
                $error['image_1'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_1 = $uuid->toString() . "." . pathinfo($image_1['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_1, $image_1['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if ($image_2['error'] !== 4) {
            if (!exif_imagetype($image_2['tmp_name'])) {
                $error['image_2'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_2 = $uuid->toString() . "." . pathinfo($image_2['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_2, $image_2['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if ($image_3['error'] !== 4) {
            if (!exif_imagetype($image_3['tmp_name'])) {
                $error['image_3'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_3 = $uuid->toString() . "." . pathinfo($image_3['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_3, $image_3['tmp_name'], ['public' => true]);
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
            "user_id" => $user_id,
            "year" => $year,
            "image_1" => isset($path_1) ? $path_1 : null,
            "image_2" => isset($path_2) ? $path_2 : null,
            "image_3" => isset($path_3) ? $path_3 : null,
            "created_at" => $formatted_date
        ]);
        if ($result) return false;

        $error["server"] = 'Terdapat gangguan, data gagal ditambahkan. Mohon coba lagi.';
        return $error;
    }

    public function update($id, $user_id, $year, $image_1, $image_2, $image_3)
    {
        // $stmt = $this->conn->prepare("UPDATE books SET title = ?, author = ?, published_year = ? WHERE id = ?");
        // $stmt->bind_param("ssii", $title, $author, $published_year, $id);
        // return $stmt->execute();
        // $this->storage->

        $old = $this->getById($id);

        $error = [];



        if ($year != $old->year) {
            $timelines = $this->conn->findBy('user_id', $user_id);
            $checkY = false;
            foreach ($timelines as $timeline) {
                if ($timeline->year == $year) {
                    $checkY = true;
                }
            }

            if ($checkY) {
                $error['year'] = 'Tahun telah memiliki timeline, pilih tahun lain.';
            }
        }

        if ($image_1['error'] !== 4) {
            if (!exif_imagetype($image_1['tmp_name'])) {
                $error['image_1'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_1 = $uuid->toString() . "." . pathinfo($image_1['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_1, $image_1['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if ($image_2['error'] !== 4) {
            if (!exif_imagetype($image_2['tmp_name'])) {
                $error['image_2'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_2 = $uuid->toString() . "." . pathinfo($image_2['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_2, $image_2['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if ($image_3['error'] !== 4) {
            if (!exif_imagetype($image_3['tmp_name'])) {
                $error['image_2'] = "File harus berformat gambar";
            } else {
                $uuid = Uuid::uuid4();
                $path_3 = $uuid->toString() . "." . pathinfo($image_3['name'], PATHINFO_EXTENSION);
                $r = $this->storage->upload($path_3, $image_3['tmp_name'], ['public' => true]);
                // $output = json_decode($r->getBody(), true);
            }
        }
        if (count($error) > 0) {
            return $error;
        }


        $result = $this->conn->update($id, [
            "user_id" => $user_id,
            "year" => $year,
            "image_1" => isset($path_1) ? $path_1 : $old->image_1,
            "image_2" => isset($path_2) ? $path_2 : $old->image_2,
            "image_3" => isset($path_3) ? $path_3 : $old->image_3,
        ]);
        if ($result) {
            $this->storage->remove([$old->image_1]);
            $this->storage->remove([$old->image_2]);
            $this->storage->remove([$old->image_3]);
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
        $image_1 = $old->image_1;
        $image_2 = $old->image_2;
        $image_3 = $old->image_3;
        if ($this->storage->remove($image_1) && $this->storage->remove($image_2) && $this->storage->remove($image_3)) {
            if ($this->conn->delete($id)) {
                return true;
            }
        }
        return false;
    }
}

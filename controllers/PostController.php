<?php
require_once 'models/Timeline.php';
require_once 'models/Post.php';

class PostController
{
    private $timelineModel;
    private $postModel;

    public function __construct($db)
    {
        $this->timelineModel = new Timeline($db);
        $this->postModel = new Post($db);
    }

    public function index()
    {
        $timelines = $this->timelineModel->getAll();
        $posts = $this->postModel->getAll();
        include 'views/post/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $timeline_id = $_POST['timeline_id'];
            $image = $_FILES['image'];
            $desc = $_POST['desc'];
            $event_date = $_POST['date'];
            $desc = $_POST['desc'];
            $error = $this->postModel->add($timeline_id, $image, $desc, $event_date);
            if (!$error) {
                $_SESSION['message'] = 'Post berhasil ditambahkan';
                header('Location: ' . BASE_URL . '/posts');
                exit;
            } else {
                $message = $error;
                $message_type = 'danger';
            }
        }
        $timelines = $this->timelineModel->getAll();
        $action = 'add';
        include 'views/post/form.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $timeline_id = $_POST['timeline_id'];
            $image = $_FILES['image'];
            $desc = $_POST['desc'];
            $event_date = $_POST['event_date'];
            $desc = $_POST['desc'];
            $error = $this->postModel->update($id, $timeline_id, $image, $desc, $event_date);
            if (!$error) {
                $_SESSION['message'] = 'Post berhasil diperbarui';
                header('Location: ' . BASE_URL . '/posts');
                exit;
            } else {
                $message = "Gagal memperbarui post.";
                $message_type = 'danger';
            }
        }
        $timelines = $this->timelineModel->getAll();
        $post = $this->postModel->getById($id);
        $action = 'edit';
        include 'views/post/form.php';
    }

    public function delete($id)
    {
        if ($this->postModel->delete($id)) {
            $_SESSION['message'] = 'Post berhasil dihapus';
        } else {
            $_SESSION['message'] = 'Gagal menghapus post';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: ' . BASE_URL . '/posts');
        exit;
    }
}

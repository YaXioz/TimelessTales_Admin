<?php
require_once 'models/Timeline.php';
require_once 'models/User.php';

class TimelineController
{
    private $timelineModel;
    private $userModel;

    public function __construct($db)
    {
        $this->timelineModel = new Timeline($db);
        $this->userModel = new User($db);
    }

    public function index()
    {
        $timelines = $this->timelineModel->getAll();
        $users = $this->userModel->getAll();
        include 'views/timeline/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'];
            $year = $_POST['year'];
            $image_1 = $_FILES['image_1'];
            $image_2 = $_FILES['image_2'];
            $image_3 = $_FILES['image_3'];
            $error = $this->timelineModel->add($user_id, $year, $image_1, $image_2, $image_3);
            if (!$error) {
                $_SESSION['message'] = 'Timeline berhasil ditambahkan';
                header('Location: ' . BASE_URL . '/timelines');
                exit;
            } else {
                $message = $error;
                $message_type = 'danger';
            }
        }
        $users = $this->userModel->getAll();
        $action = 'add';
        include 'views/timeline/form.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $user_id = $_POST['user_id'];
            $year = $_POST['year'];
            $image_1 = $_FILES['image_1'];
            $image_2 = $_FILES['image_2'];
            $image_3 = $_FILES['image_3'];
            $error = $this->timelineModel->update($id, $user_id, $year, $image_1, $image_2, $image_3);
            if (!$error) {
                $_SESSION['message'] = 'Timeline berhasil diperbarui';
                header('Location: ' . BASE_URL . '/timelines');
                exit;
            } else {
                $message = "Gagal memperbarui timeline.";
                $message_type = 'danger';
            }
        }
        $timeline = $this->timelineModel->getById($id);
        $users = $this->userModel->getAll();
        $action = 'edit';
        include 'views/timeline/form.php';
    }

    public function delete($id)
    {
        if ($this->timelineModel->delete($id)) {
            $_SESSION['message'] = 'Timeline berhasil dihapus';
        } else {
            $_SESSION['message'] = 'Gagal menghapus timeline';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: ' . BASE_URL . '/users');
        exit;
    }
}

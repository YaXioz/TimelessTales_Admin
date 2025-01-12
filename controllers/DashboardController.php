<?php
require_once 'models/User.php';
require_once 'models/Timeline.php';
require_once 'models/Post.php';

class DashboardController
{
    private $userModel;
    private $timelineModel;
    private $postModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
        $this->timelineModel = new Timeline($db);
        $this->postModel = new Post($db);
    }

    public function index()
    {
        $users = count($this->userModel->getAll());
        $timelines = count($this->timelineModel->getAll());
        $posts = count($this->postModel->getAll());
        include 'views/dashboard/index.php';
    }
}

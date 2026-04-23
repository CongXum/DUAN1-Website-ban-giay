<?php

require_once __DIR__ . '/../../Model/Comment.php';

class CommentController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new Comment($conn);
    }

    public function index()
    {
        $keyword = $_GET['keyword'] ?? '';
        $status  = $_GET['status'] ?? '';

        $page = $_GET['p'] ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $comments = $this->model->getAll($keyword, $status, $limit, $offset);
        $total = $this->model->countAll($keyword, $status);

        $totalPages = ceil($total / $limit);

        require __DIR__ . "/../View/Modules/Comment/Index.php";
    }

    public function approve()
    {
        $this->model->approve($_GET['id']);
        header("Location:?page=comments");
        exit;
    }

    public function reject()
    {
        $this->model->reject($_GET['id']);
        header("Location:?page=comments");
        exit;
    }

    public function delete()
    {
        $this->model->delete($_GET['id']);
        header("Location:?page=comments");
        exit;
    }
}

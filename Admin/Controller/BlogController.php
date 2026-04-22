<?php

class BlogController
{
    private $blogModel;

    public function __construct($blogModel)
    {
        $this->blogModel = $blogModel;
    }

    // Hiển thị danh sách bài viết
    public function index()
    {
        $page = $_GET['p'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $status = $_GET['status'] ?? null;

        $blogs = $this->blogModel->getAll($limit, $offset, $status);

        require_once __DIR__ . '/../View/Modules/Blogs/Index.php';
    }

    // Hiển thị form thêm bài viết

    public function create()
    {
        require_once __DIR__ . '/../View/Modules/Blogs/Create.php';
    }

    // Xử lý thêm bài viết
    public function store()
    {
        $data = [
            'title' => $_POST['title'],
            'slug' => $this->toSlug($_POST['title']),
            'content' => $_POST['content'],
            'thumbnail' => $_POST['thumbnail'] ?? null,
            'category_id' => $_POST['category_id'] ?? null,
            'author' => $_POST['author'],
            'status' => $_POST['status'] ?? 0
        ];
        $this->blogModel->create($data);

        header('Location: index.php?page=blogs');
        exit;
    }

    // form edit bài viết
    public function edit()
    {

        $id = $_GET['id'];
        $blog = $this->blogModel->getOne($id);

        require_once __DIR__ . '/../View/Modules/Blogs/Edit.php';
    }

    // Xử lý cập nhật bài viết
    public function update()
    {
        $id = $_POST['id'];

        $data = [
            'title' => $_POST['title'],
            'slug' => $this->toSlug($_POST['title']),
            'content' => $_POST['content'],
            'thumbnail' => $_POST['thumbnail'] ?? null,
            'category_id' => $_POST['category_id'] ?? null,
            'author' => $_POST['author'],
            'status' => $_POST['status']
        ];

        $this->blogModel->update($id, $data);
        header('Location: index.php?page=blogs');
        exit;
    }

    // Xóa bài viết
    public function delete()
    {
        $id = $_GET['id'];
        $this->blogModel->delete($id);
        header('Location: index.php?page=blogs');
        exit;
    }

    // Xem chi tiết bài viết
    public function show () {
        $id = $_GET['id'];
        $blog = $this->blogModel->getOne($id);

        require_once __DIR__ . '/../View/Modules/Blogs/Show.php';
    }

    // Hàm chuyển tiêu đề thành slug
    private function toSlug($str)
    {
        $str = strtolower($str);
        $str = trim($str);

        $str = preg_replace('/[^a-z0-9]+/i', '-', $str);
        $str = preg_replace('/[\s-]+/', '-', $str);
        $str = preg_replace('/\s/', '-', $str);
        return $str;
    }
}

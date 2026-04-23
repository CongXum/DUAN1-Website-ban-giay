<?php

class BlogController
{
    private $blogModel;
    private $categoryModel;

    public function __construct($conn)
    {
        require_once dirname(__DIR__, 2) . '/Model/Blogs.php';
        require_once dirname(__DIR__, 2) . '/Model/BlogCategory.php';

        $this->blogModel = new Blog($conn);
        $this->categoryModel = new BlogCategory($conn);
    }

    // LIST
    public function index()
    {
        $page = $_GET['p'] ?? 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $keyword = $_GET['keyword'] ?? null;
        $categoryId = $_GET['category_id'] ?? null;

        $blogs = $this->blogModel->getAllWithFilter(
            $limit,
            $offset,
            1,
            $keyword,
            $categoryId
        );

        $categories = $this->categoryModel->getAll();

        return [
            'blogs' => $blogs,
            'categories' => $categories
        ];
    }

    // DETAIL
    public function detail($id)
    {
        $blog = $this->blogModel->getOne($id);

        if (!$blog) {
            header("Location: index.php?page=blogs");
            exit;
        }

        $this->blogModel->incrementViews($id);

        return $blog;
    }
}

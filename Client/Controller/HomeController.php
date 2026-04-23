<?php

require_once __DIR__ . '/../../Model/Product.php';
require_once __DIR__ . '/../../Model/Blogs.php';

class HomeController
{

    private $productModel;
    private $blogModel;

    public function __construct($conn)
    {
        $this->productModel = new Product($conn);
        $this->blogModel = new Blog($conn);
    }

    public function index()
    {
        // lấy dữ liệu
        $products   = $this->productModel->getLatest(8);
        $categories = $this->productModel->getAllCategories();
        $blogs      = $this->blogModel->getLatest(3);

        // load view
        require_once __DIR__ . '/../View/Pages/Home.php';
    }
}

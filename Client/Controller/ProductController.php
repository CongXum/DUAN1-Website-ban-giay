<?php

class ProductController
{
    private $productModel;
    private $commentModel;

    public function __construct($productModel, $commentModel)
    {
        $this->productModel = $productModel;
        $this->commentModel = $commentModel;
    }

    // ======================
    // LIST PRODUCT
    // ======================
    public function index()
    {
        $category_id = (int)($_GET['cat'] ?? 0);
        $search = trim($_GET['search'] ?? '');
        $page = max(1, (int)($_GET['p'] ?? 1));
        $perPage = 8;

        $products = $category_id > 0
            ? $this->productModel->getByCategory($category_id)
            : $this->productModel->getAll();

        if ($search !== '') {
            $products = array_values(array_filter($products, function ($p) use ($search) {
                return stripos($p['title'], $search) !== false;
            }));
        }

        $total = count($products);
        $totalPages = max(1, ceil($total / $perPage));

        $offset = ($page - 1) * $perPage;
        $products = array_slice($products, $offset, $perPage);

        $categories = $this->productModel->getAllCategories();

        require __DIR__ . '/../View/Pages/Product/ProductItems.php';
    }

    // ======================
    // DETAIL PRODUCT + COMMENTS
    // ======================
    public function detail()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) die("ID không hợp lệ");

        $item = $this->productModel->getOne($id);
        if (!$item) die("Sản phẩm không tồn tại");

        $category = $this->productModel->getCategoryById($item['category_id'] ?? 0);

        // COMMENTS (CHỈ APPROVED)
        $comments = $this->commentModel->getByProduct($id);
        

        require __DIR__ . '/../View/Pages/Product/DetailProduct.php';
    }
}

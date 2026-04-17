<?php
class CategoryController {
    private $category;

    public function __construct($categoryModel) {
        $this->category = $categoryModel;
    }

    // Liệt kê danh mục
    public function index() {
        $categories = $this->category->getAll();
        include __DIR__ . '/../View/Modules/Categories/Index.php';
    }

    // Thêm danh mục
    public function create() {
        if (isset($_POST['create'])) {
            $this->category->insert($_POST['name']);
            header("Location: /Admin/index.php?page=categories");
            exit;
        }
        include __DIR__ . '/../View/Modules/Categories/Create.php';
    }

    // Sửa danh mục
    public function edit() {
        $id = $_GET['id'] ?? null;
        $cat = $this->category->getOne($id);

        if (isset($_POST['update'])) {
            $this->category->update($id, $_POST['name']);
            header("Location: /Admin/index.php?page=categories");
            exit;
        }
        include __DIR__ . '/../View/Modules/Categories/Edit.php';
    }

    // Xóa danh mục
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->category->delete($id);
        }
        header("Location: /Admin/index.php?page=categories");
        exit;
    }
}
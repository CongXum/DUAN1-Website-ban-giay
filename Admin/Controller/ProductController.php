<?php
class ProductController
{
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->getAll();
        include __DIR__ . '/../View/Modules/Products/Index.php';
    }

    public function create()
    {
        $categories = $this->product->getAllCategories();
        if (isset($_POST['create'])) {
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmp, __DIR__ . '/../../public/images/' . $image);

            $this->product->insert(
                $_POST['title'],
                $_POST['qty'],
                $_POST['created_at'],
                $image,
                $_POST['description'],
                $_POST['price'],
                $_POST['category_id']
            );
            header("Location: /Admin/index.php?page=products");
            exit;
        }
        include __DIR__ . '/../View/Modules/Products/Create.php';
    }

    // MỚI: Thêm hàm Edit để xử lý Update
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=products");
            exit;
        }

        $p = $this->product->getOne($id);
        $categories = $this->product->getAllCategories();

        if (isset($_POST['update'])) {
            $image = $_FILES['image']['name'];
            if ($image != "") {
                $tmp = $_FILES['image']['tmp_name'];
                move_uploaded_file($tmp, __DIR__ . '/../../public/images/' . $image);
            } else {
                $image = $p['images']; // Lấy lại ảnh cũ nếu không chọn ảnh mới
            }

            $this->product->update(
                $_POST['title'],
                $_POST['qty'],
                $_POST['created_at'],
                $image,
                $_POST['description'],
                $_POST['price'],
                $_POST['category_id'],
                $id
            );
            header("Location: /Admin/index.php?page=products");
            exit;
        }
        include __DIR__ . '/../View/Modules/Products/Edit.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->product->delete($id);
        }
        // Sau khi xóa xong quay về trang danh sách ngay lập tức
        header("Location: /Admin/index.php?page=products");
        exit;
    }
}
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page = $_GET['page'] ?? 'dashboard';

// 1. Require các Model
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/Product.php';
require_once __DIR__ . '/../Model/Category.php'; // Đã thêm
require_once __DIR__ . '/../Model/User.php'; // Thêm User model

// 2. Require các Controller
require_once __DIR__ . '/Controller/ProductController.php';
require_once __DIR__ . '/Controller/CategoryController.php'; // Đã thêm
require_once __DIR__ . '/Controller/UserController.php'; // Thêm User controller

// 3. Khởi tạo kết nối Database
$db = new Database();
$conn = $db->connect();

// 4. Khởi tạo Model và Controller cho Sản phẩm
$productModel = new Product($conn);
$productController = new ProductController($productModel);

// 5. Khởi tạo Model và Controller cho Danh mục
$categoryModel = new Category($conn);
$categoryController = new CategoryController($categoryModel);

// 6. Khởi tạo Model và Controller cho Người dùng
$userModel = new User($conn);
$userController = new UserController($userModel);

// 6. Giao diện Header & Sidebar
include __DIR__ . '/View/layouts/Header.php';
include __DIR__ . '/View/layouts/Sidebar.php';
?>

<div class="content">

<?php
switch($page){
    // ================= QUẢN LÝ SẢN PHẨM =================
    case 'products':
        $productController->index();
        break;

    case 'product-create':
        $productController->create();
        break;

    case 'product-edit':
        $productController->edit();
        break;

    case 'product-delete':
        $productController->delete();
        break;

    // ================= QUẢN LÝ DANH MỤC (MỚI THÊM) =================
    case 'categories':
        $categoryController->index();
        break;

    case 'category-create':
        $categoryController->create();
        break;

    case 'category-edit':
        $categoryController->edit();
        break;

    case 'category-delete':
        $categoryController->delete();
        break;

    // ================= QUẢN LÝ NGƯỜI DÙNG =================
    case 'users':
        $userController->index();
        break;

    case 'user-create':
        $userController->create();
        break;

    case 'user-edit':
        $userController->edit();
        break;

    case 'user-delete':
        $userController->delete();
        break;

    case 'user-lock':
        $userController->lock();
        break;

    case 'user-unlock':
        $userController->unlock();
        break;

    case 'user-view':
        $userController->view();
        break;

    // ================= MẶC ĐỊNH =================
    default:
        echo "<h2>Dashboard</h2>";
        break;
}
?>

</div>

<?php include __DIR__ . '/View/Layouts/Footer.php'; ?>
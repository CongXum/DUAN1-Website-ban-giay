<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// =======================
// LOAD MODELS
// =======================
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/Product.php';
require_once __DIR__ . '/../Model/Category.php';
require_once __DIR__ . '/../Model/Order.php';
require_once __DIR__ . '/../Model/Blogs.php';
require_once __DIR__ . '/../Model/BlogCategory.php';
require_once __DIR__ . '/../Model/User.php';

// =======================
// LOAD CONTROLLERS
// =======================
require_once __DIR__ . '/Controller/ProductController.php';
require_once __DIR__ . '/Controller/CategoryController.php';
require_once __DIR__ . '/Controller/OrderController.php';
require_once __DIR__ . '/Controller/BlogController.php';
require_once __DIR__ . '/Controller/UserController.php';

// =======================
// CONNECT DB
// =======================
$db   = new Database();
$conn = $db->connect();

// =======================
// INIT MODEL
// =======================
$productModel       = new Product($conn);
$categoryModel      = new Category($conn);
$blogModel          = new Blog($conn);
$blogCategoryModel  = new BlogCategory($conn);
$userModel          = new User($conn);

// =======================
// INIT CONTROLLER
// =======================
$blogController = new BlogController($blogModel, $blogCategoryModel);
$userController = new UserController($userModel);
$productController  = new ProductController($productModel);
$categoryController = new CategoryController($conn, $categoryModel);

// =======================
// ROUTE
// =======================
$page = $_GET['page'] ?? 'dashboard';

// =====================================================
// LAYOUT
// =====================================================
include __DIR__ . '/View/Layouts/Header.php';
include __DIR__ . '/View/Layouts/Sidebar.php';
?>

<div class="content">
    <?php
    // Flash
    if (!empty($_SESSION['success'])) {
        echo "<div class='alert alert-success mx-3 mt-3'>{$_SESSION['success']}</div>";
        unset($_SESSION['success']);
    }
    if (!empty($_SESSION['error'])) {
        echo "<div class='alert alert-danger mx-3 mt-3'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']);
    }

    // =======================
    // SWITCH ROUTE
    // =======================
    switch ($page) {

        // products
        case 'products':
            include 'View/Modules/Products/Index.php';
            break;

        case 'create-product':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $productController->store()
                : include 'View/Modules/Products/Create.php';
            break;

        case 'update-product':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $productController->update()
                : include 'View/Modules/Products/Update.php';
            break;

        case 'delete-product':
            $productController->delete();
            break;

        // categories
        case 'categories':
            include 'View/Modules/Categories/Index.php';
            break;

        case 'create-category':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $categoryController->store()
                : include 'View/Modules/Categories/Create.php';
            break;

        case 'edit-category':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $categoryController->update()
                : include 'View/Modules/Categories/Edit.php';
            break;

        case 'delete-category':
            $categoryController->delete();
            break;

        // orders
        case 'orders':
            (new OrderController($conn))->index();
            break;

        case 'order-detail':
            (new OrderController($conn))->detail();
            break;

        case 'update-status':
            (new OrderController($conn))->updateStatus();
            break;

        // blogs
        case 'blogs':
            $blogController->index();
            break;

        case 'create-blog':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $blogController->store($_POST, $_FILES)
                : $blogController->create();
            break;

        case 'update-blog':
            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $blogController->update($_POST, $_FILES)
                : $blogController->edit();
            break;

        case 'delete-blog':
            $blogController->delete();
            break;

        case 'view-blog':
            $blogController->show();
            break;
        // blog categories
        case 'create-blog-category':
            $blogController->categoryStore();
            break;

        case 'update-blog-category':
            $blogController->categoryUpdate();
            break;

        case 'delete-blog-category':
            $blogController->categoryDelete();
            break;

        // users
        case 'users':
            $userController->index();
            break;

        case 'user-create':
            $userController->create();
            break;

        case 'user-edit':
            $userController->edit();
            break;

        case 'user-view':
            $userController->view();
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

        // settings
        case 'settings':
            include 'View/Modules/Settings/Index.php';
            break;

        // default dashboard
        default:
            include 'View/Modules/Dashboard/Index.php';
            break;
    }
    ?>
</div>

<?php include __DIR__ . '/View/Layouts/Footer.php'; ?>
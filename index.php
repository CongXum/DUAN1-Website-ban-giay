<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// =====================
// MODEL
// =====================
require_once __DIR__ . '/Model/Database.php';
require_once __DIR__ . '/Model/Product.php';
require_once __DIR__ . '/Model/User.php';
require_once __DIR__ . '/Model/Cart.php';
require_once __DIR__ . '/Model/Order.php';
require_once __DIR__ . '/Model/Blogs.php';
require_once __DIR__ . '/Model/BlogCategory.php';
require_once __DIR__ . '/Model/Comment.php';

// =====================
// CONTROLLER
// =====================
require_once __DIR__ . '/Client/Controller/CartController.php';
require_once __DIR__ . '/Client/Controller/OrderController.php';
require_once __DIR__ . '/Client/Controller/ProductController.php';

// =====================
// DB CONNECT
// =====================
$db = new Database();
$conn = $db->connect();

// =====================
// MODEL INIT
// =====================
$product = new Product($conn);
$userModel = new User($conn);
$orderModel = new Order($conn);
$cartModel = new Cart($conn);
$commentModel = new Comment($conn);

// =====================
// CONTROLLER INIT
// =====================
$productController = new ProductController($product, $commentModel);
$orderController = new OrderController($orderModel, $cartModel);
$cartController = new CartController($cartModel);

// =====================
// SAFE AUTH HELPER (FIX COMMENT ISSUE)
// =====================
function auth_user_id()
{
    return $_SESSION['user_id']
        ?? ($_SESSION['user']['id'] ?? 0);
}

// =====================
// PAGE
// =====================
$page = isset($_GET['page']) ? strtolower(trim($_GET['page'])) : 'home';


// ============================
// HANDLE ACTION
// ============================
switch ($page) {

    case 'place-order':
        $orderController->placeOrder();
        exit;

    case 'cancel-order':
        $orderController->cancel();
        exit;

    case 'mark-paid':
        $orderController->markPaid();
        exit;

    case 'update-cart':
        $cartController->update();
        exit;

    case 'add-cart':
        $cartController->add();
        exit;

    case 'delete-cart':
        $cartController->delete();
        exit;
}


// ============================
// HEADER
// ============================
include __DIR__ . '/Client/View/Layouts/Header.php';


// ============================
// ROUTER VIEW
// ============================
switch ($page) {

    case 'home':
        require_once 'Client/Controller/HomeController.php';
        $home = new HomeController($conn);
        $home->index();
        break;

    case 'login':
        include __DIR__ . '/Client/View/Pages/Login.php';
        break;

    case 'register':
        include __DIR__ . '/Client/View/Pages/Register.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php");
        exit;

        // ======================
        // PRODUCT
        // ======================
    case 'product':
    case 'product-items':
        $productController->index();
        break;

    case 'product-detail':
    case 'detail':
        $productController->detail();
        break;

    // ======================
    // COMMENT (FIXED CORE HERE)
    // ======================
    case 'add-comment':

        $user_id = $_SESSION['user']['id'] ?? $_SESSION['user_id'] ?? 0;
        $product_id = (int)($_POST['product_id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        if ($user_id <= 0) {
            die("Bạn phải đăng nhập");
        }

        if ($product_id <= 0 || $content === '') {
            die("Dữ liệu không hợp lệ");
        }

        if (mb_strlen($content) < 3) {
            die("Bình luận quá ngắn");
        }

        if (mb_strlen($content) > 500) {
            die("Bình luận quá dài");
        }

        $commentModel->create($user_id, $product_id, $content);

        $_SESSION['flash_success'] = "Bình luận thành công!";

        header("Location: index.php?page=product-detail&id=$product_id");
        exit;

        // ======================
        // CART
        // ======================
    case 'cart':
        $cartController->index();
        break;

    case 'checkout':
        include 'Client/View/Pages/Checkout.php';
        break;

    case 'order-detail':
        include 'Client/View/Pages/OrderDetail.php';
        break;

    case 'order':
        $ordersModel = $orderModel;
        include __DIR__ . '/Client/View/Pages/Orders.php';
        break;

    case 'success':
        include 'Client/View/Pages/success.php';
        break;

    // ======================
    // CONTACT
    // ======================
    case 'contact':
        include __DIR__ . '/Client/View/Pages/Contact.php';
        break;

    // ======================
    // BLOG
    // ======================
    case 'blogs':
        require_once __DIR__ . '/Client/Controller/BlogController.php';

        $blogController = new BlogController($conn);
        $data = $blogController->index();

        $blogs = $data['blogs'] ?? [];
        $categories = $data['categories'] ?? [];

        include __DIR__ . '/Client/View/Pages/Blogs/index.php';
        break;

    case 'blog-detail':
        require_once __DIR__ . '/Client/Controller/BlogController.php';

        $blogController = new BlogController($conn);
        $blog = $blogController->detail($_GET['id'] ?? 0);

        include __DIR__ . '/Client/View/Pages/Blogs/detail.php';
        break;

    // ======================
    // DEFAULT
    // ======================
    default:
        require_once 'Client/Controller/HomeController.php';
        $home = new HomeController($conn);
        $home->index();
        break;
}


// ============================
// FOOTER
// ============================
include __DIR__ . '/Client/View/Layouts/Footer.php';

ob_end_flush();

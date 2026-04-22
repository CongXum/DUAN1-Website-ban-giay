<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Model/Database.php';
require_once __DIR__ . '/Model/Product.php';
require_once __DIR__ . '/Model/User.php'; // Require thêm model User
// require các model khác nếu cần...


require_once __DIR__ . '/Model/Cart.php';
require_once __DIR__ . '/Client/Controller/CartController.php';
require_once __DIR__ . '/Model/Order.php';
require_once __DIR__ . '/Client/Controller/OrderController.php';

$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
$userModel = new User($conn); // Khởi tạo User model

$page = isset($_GET['page']) ? strtolower(trim($_GET['page'])) : 'home';

/**
 * ============================
 * ✅ XỬ LÝ LOGIC TRƯỚC
 * ============================
 */
switch ($page) {
    case 'login':
        include __DIR__ . '/Client/View/Pages/Login.php';
        break;
    case 'register':
        include __DIR__ . '/Client/View/Pages/Register.php';
        break;
    case 'logout':
        session_destroy();
        echo "<script>window.location.href='index.php';</script>";
        break;
    case 'cart':
        $cartModel = new Cart($conn);
        $cartController = new CartController($cartModel);

        if (isset($_GET['action']) && $_GET['action'] === 'add') {
            $cartController->add();
        }
        break;


    case 'update-cart':
        $cartModel = new Cart($conn);
        $cartController = new CartController($cartModel);
        $cartController->update();
        break;


    case 'delete-cart':
        $cartModel = new Cart($conn);
        $cartController = new CartController($cartModel);
        $cartController->delete();
        break;


    case 'place-order':
        $orderModel = new Order($conn);
        $cartModel = new Cart($conn);

        $controller = new OrderController($orderModel, $cartModel);
        $controller->placeOrder();
        break;
}


/**
 * ============================
 * ✅ LOAD HEADER
 * ============================
 */
include __DIR__ . '/Client/View/Layouts/Header.php';


/**
 * ============================
 * ✅ HIỂN THỊ GIAO DIỆN
 * ============================
 */
switch ($page) {

    case 'home':
        require_once 'Client/Controller/HomeController.php';
        $home = new HomeController();
        $home->index();
        break;


    case 'product':
        include __DIR__ . '/Client/View/Pages/Product/ProductItems.php';
        break;


    case 'detail':
        include __DIR__ . '/Client/View/Pages/Product/DetailProduct.php';
        break;


    case 'cart':
        $cartController->index();
        break;

    case 'vietqr':
        $orderModel = new Order($conn);

        $order_id = $_GET['order_id'] ?? 0;
        $order = $orderModel->getOne($order_id);

        if (!$order) {
            echo "Đơn hàng không tồn tại";
            exit;
        }

        // ✅ TẠO BIẾN Ở ĐÂY
        $bank = "970422";
        $account = "0396928846";
        $amount = $order['total'];
        $content = "ORDER" . $order_id;

        $qr_url = "https://img.vietqr.io/image/{$bank}-{$account}-compact2.png?amount={$amount}&addInfo={$content}";

        require_once 'Client/View/Pages/vietqr.php';
        break;

    case 'mark-paid':
        $orderModel = new Order($conn);
        $cartModel = new Cart($conn);

        $controller = new OrderController($orderModel, $cartModel);
        $controller->markPaid();
        exit;

    case 'checkout':
        $cartModel = new Cart($conn);
        require_once 'Client/View/Pages/Checkout.php';
        break;

    case 'product-items':
        include 'Client/View/Pages/Product/ProductItems.php';
        break;


    case 'orders':
        $orderModel = new Order($conn);
        include 'Client/View/Pages/Orders.php';
        break;


    case 'order-detail':
        $orderModel = new Order($conn);
        include 'Client/View/Pages/OrderDetail.php';
        break;


    case 'contact':
        include __DIR__ . '/Client/View/Pages/Contact.php';
        break;


    case 'success':
        require_once 'Client/View/Pages/success.php';
        break;


    default:
        require_once 'Client/Controller/HomeController.php';
        $home = new HomeController();
        $home->index();
        break;
}


/**
 * ============================
 * ✅ LOAD FOOTER
 * ============================
 */
include __DIR__ . '/Client/View/Layouts/Footer.php';

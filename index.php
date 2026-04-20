<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Model/Database.php';
require_once __DIR__ . '/Model/Product.php';
require_once __DIR__ . '/Model/User.php'; // Require thêm model User
// require các model khác nếu cần...

$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
$userModel = new User($conn); // Khởi tạo User model

$page = isset($_GET['page']) ? strtolower(trim($_GET['page'])) : 'home';

include __DIR__ . '/Client/View/Layouts/Header.php';

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
        include 'Client/View/Pages/Cart.php';
        break;
    case 'product':
        include __DIR__ . '/Client/View/Pages/Product/ProductItems.php';
        break;
    case 'contact':
        include __DIR__ . '/Client/View/Pages/Contact.php';
        break;
    case 'home':
        include __DIR__ . '/Client/View/Pages/Home.php';
        break;
    case 'orders':
        include 'Client/View/Pages/Orders.php';
        break;

    case 'product-detail':
        include 'Client/View/Pages/Product/DetailProduct.php';
        break;

    case 'product-categories':
        include 'Client/View/Pages/Product/ProductCategories.php';
        break;

    case 'product-items':
        include 'Client/View/Pages/Product/ProductItems.php';
        break;
    case 'detail':
        include __DIR__ . '/Client/View/Pages/Product/DetailProduct.php';
        break;
    case 'order':
        include __DIR__ . '/Client/View/Pages/Orders.php';
        break;

        // case 'shop':           // sau này thêm
        //     include __DIR__ . '/Client/View/Pages/Shop.php';
        //     break;


}

include __DIR__ . '/Client/View/Layouts/Footer.php';

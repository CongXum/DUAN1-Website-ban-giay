<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/Model/Database.php';
require_once __DIR__ . '/Model/Product.php';
require_once __DIR__ . '/Model/Category.php';
require_once __DIR__ . '/Model/User.php';
require_once __DIR__ . '/Model/Order.php';

$db = new Database();
$conn = $db->connect();

$product = new Product($conn);

// Lấy 1 sản phẩm
$data = $product->getOne(1);

echo "<pre>";
print_r($data);
echo "</pre>";


// Lấy tất cả sản phẩm
$list = $product->getAll();

echo "<pre>";
print_r($list);
echo "</pre>";

$user = new User($conn);
$user_update = new User($conn);
$delete = new User($conn);


$delete = $delete->delete("8");


//Chuyển trang cho client
$page = $_GET['page'] ?? 'home';

/* =========================
   CLIENT ROUTER
========================= */
switch ($page) {

    case 'home':
        include 'Client/View/Pages/Home.php';
        break;

    case 'cart':
        include 'Client/View/Pages/Cart.php';
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

    default:
        include 'Client/View/Pages/Home.php';
        break;
}





?>

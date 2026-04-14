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

?>

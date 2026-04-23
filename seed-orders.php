<?php
// Seed script - Chạy 1 lần: php seed-orders.php
require_once 'Model/Database.php';

$db = new Database();
$conn = $db->connect();
if (!$conn) {
    die("DB connect fail\n");
}

echo "Seeding orders...\n";

// Clear existing
$conn->exec("TRUNCATE TABLE orders");
$conn->exec("TRUNCATE TABLE order_details");

// Insert 12 sample orders
$orders = [
    ['user_id'=>1, 'total_amount'=>1500000, 'status'=>'completed'],
    ['user_id'=>2, 'total_amount'=>850000, 'status'=>'pending'], 
    ['user_id'=>3, 'total_amount'=>2200000, 'status'=>'completed'],
    ['user_id'=>1, 'total_amount'=>450000, 'status'=>'cancelled'],
    ['user_id'=>4, 'total_amount'=>1200000, 'status'=>'shipping'],
    ['user_id'=>5, 'total_amount'=>950000, 'status'=>'pending'],
    ['user_id'=>2, 'total_amount'=>1800000, 'status'=>'completed'],
    ['user_id'=>6, 'total_amount'=>650000, 'status'=>'cancelled'],
    ['user_id'=>3, 'total_amount'=>2900000, 'status'=>'shipping'],
    ['user_id'=>1, 'total_amount'=>750000, 'status'=>'pending'],
    ['user_id'=>7, 'total_amount'=>1100000, 'status'=>'completed'],
    ['user_id'=>4, 'total_amount'=>1350000, 'status'=>'pending'],
];

$orderStmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)");
$detailStmt = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

foreach ($orders as $o) {
    $orderStmt->execute([$o['user_id'], $o['total_amount'], $o['status']]);
    $orderId = $conn->lastInsertId();
    
    // 2-4 products per order
    $prods = [[1,2,899000], [2,1,450000], [3,3,299000], [4,1,1290000]];
    shuffle($prods);
    for ($i=0; $i<rand(2,4); $i++) {
        [$pid, $qty, $price] = $prods[$i];
        $detailStmt->execute([$orderId, $pid, $qty, $price]);
    }
    echo "Order $orderId created\n";
}

echo "✅ Seeded " . count($orders) . " orders + details!\n";
echo "Test: Admin/index.php?page=orders\n";
?>


<?php


class Order
{


    protected $table = "orders";
    public $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getByUser($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table ";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id)
{
    $sql = "SELECT * FROM orders WHERE id = :idDonHang";

    $sth = $this->_connect->prepare($sql);
    $sth->execute(['idDonHang' => $id]);

    return $sth->fetch(PDO::FETCH_ASSOC);
}


    public function getDetailOrder(int $id)
    {
        $sql = "SELECT 
                order_details.*, 
                products.title, 
                products.images
            FROM order_details
            JOIN products 
            ON products.id = order_details.product_id
            WHERE order_details.order_id = :idDonHang";

        $sth = $this->_connect->prepare($sql);
        $sth->execute([':idDonHang' => $id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    //them order// 🔥 Tạo order
    public function createOrder($user_id, $name, $email, $phone, $address, $total, $payment_method)
{
    $sql = "INSERT INTO orders 
    (user_id, name, email, phone, address, total, status, payment_method, created_at)
    VALUES (?, ?, ?, ?, ?, ?, 'pending', ?, NOW())";

    $stmt = $this->_connect->prepare($sql);
    $stmt->execute([$user_id, $name, $email, $phone, $address, $total, $payment_method]);

    return $this->_connect->lastInsertId();
}

    // 🔥 Thêm order_detail
    public function insertOrderDetail($order_id, $product_id, $qty, $price)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, qty, price)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$order_id, $product_id, $qty, $price]);
    }
}

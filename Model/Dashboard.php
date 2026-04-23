<?php

class DashboardModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Tổng users
    public function totalUsers()
    {
        return $this->conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
    }

    // Tổng sản phẩm
    public function totalProducts()
    {
        return $this->conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
    }

    // Tổng đơn
    public function totalOrders()
    {
        return $this->conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    }

    // Doanh thu hôm nay
    public function revenueToday()
    {
        return $this->conn->query("
            SELECT SUM(total)
            FROM orders
            WHERE DATE(created_at)=CURDATE()
            AND status='completed'
        ")->fetchColumn() ?? 0;
    }

    // Đơn hôm nay
    public function ordersToday()
    {
        return $this->conn->query("
            SELECT COUNT(*)
            FROM orders
            WHERE DATE(created_at)=CURDATE()
        ")->fetchColumn();
    }

    // User mới hôm nay
    public function newUsersToday()
    {
        return $this->conn->query("
            SELECT COUNT(*)
            FROM users
            WHERE DATE(created_at)=CURDATE()
        ")->fetchColumn();
    }

    // Sản phẩm hết hàng
    public function outOfStock()
    {
        return $this->conn->query("
            SELECT COUNT(*)
            FROM products
            WHERE qty <= 0
        ")->fetchColumn();
    }

    // 5 đơn gần nhất
    public function latestOrders()
    {
        return $this->conn->query("
            SELECT orders.id,
                   users.name,
                   orders.total,
                   orders.status
            FROM orders
            JOIN users ON users.id=orders.user_id
            ORDER BY orders.created_at DESC
            LIMIT 5
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    // chart doanh thu 7 ngày
    public function revenue7Days()
    {
        return $this->conn->query("
            SELECT DATE(created_at) as day,
                   SUM(total) as revenue
            FROM orders
            WHERE created_at >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)
            AND status='completed'
            GROUP BY DATE(created_at)
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}

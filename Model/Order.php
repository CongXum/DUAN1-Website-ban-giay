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
        $sth->execute([':idDonHang' => $id]);

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

    public function updateStatus($order_id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$status, $order_id]);
    }

    public function getAllAdmin($keyword = '', $status = '', $page = 1, $limit = 10)
    {
        $sql = "SELECT * FROM orders WHERE 1";

        $params = [];

        // 🔍 search theo mã đơn
        if (!empty($keyword)) {
            $sql .= " AND id LIKE ?";
            $params[] = "%$keyword%";
        }

        // 🎯 filter status
        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        // 📄 pagination
        $offset = ($page - 1) * $limit;
        $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

        $sth = $this->_connect->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔢 đếm tổng
    public function countAllAdmin($keyword = '', $status = '')
    {
        $sql = "SELECT COUNT(*) FROM orders WHERE 1";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND id LIKE ?";
            $params[] = "%$keyword%";
        }

        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        $sth = $this->_connect->prepare($sql);
        $sth->execute($params);

        return $sth->fetchColumn();
    }

    public function getAllPagination($limit, $offset)
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $sth = $this->_connect->prepare($sql);
        $sth->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $sth->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC)['total'];
    }
}

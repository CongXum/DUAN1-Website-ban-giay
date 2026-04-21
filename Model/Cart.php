<?php

class Cart
{

    protected $table = "carts";
    protected $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    // ✅ Lấy giỏ hàng + thông tin sản phẩm
    public function getAll(int $user_id)
    {
        $sql = "SELECT c.*, p.title, p.price 
            FROM carts c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Lấy 1 item
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Thêm vào giỏ hàng
    public function addToCart($user_id, $product_id, $qty = 1)
    {

        // check tồn tại
        $sql = "SELECT * FROM $this->table 
                WHERE user_id = ? AND product_id = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id, $product_id]);
        $item = $sth->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // tăng số lượng
            $sql = "UPDATE $this->table 
                    SET qty = qty + ? 
                    WHERE user_id = ? AND product_id = ?";
            $stmt = $this->_connect->prepare($sql);
            return $stmt->execute([$qty, $user_id, $product_id]);
        } else {
            // thêm mới
            $sql = "INSERT INTO $this->table (user_id, product_id, qty) 
                    VALUES (?, ?, ?)";
            $stmt = $this->_connect->prepare($sql);
            return $stmt->execute([$user_id, $product_id, $qty]);
        }
    }

    // ✅ Cập nhật số lượng
    public function update($qty, $id, $user_id)
    {
        $sql = "UPDATE $this->table 
            SET qty = ? 
            WHERE id = ? AND user_id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$qty, $id, $user_id]);
    }

    // ✅ Xóa 1 sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }

    // ✅ Xóa toàn bộ giỏ hàng theo user
    public function clearCart($user_id)
    {
        $sql = "DELETE FROM $this->table WHERE user_id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    // ✅ Tính tổng tiền
    public function getTotal($user_id)
    {
        $sql = "SELECT SUM(p.price * c.qty) as total
                FROM $this->table c
                JOIN products p ON c.product_id = p.id
                WHERE c.user_id = ?";

        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id]);
        return $sth->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }
}

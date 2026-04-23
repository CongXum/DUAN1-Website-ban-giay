<?php


class Order {


    protected $table = "orders";
    protected $_connect;    

    public function __construct($connect) {
        $this->_connect = $connect;
    }

    // Lấy tất cả
    public function getAll() {
        $sql = "SELECT * FROM $this->table ";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id)
{
    $sql = "SELECT * FROM orders
            JOIN users 
            ON users.id = orders.user_id
            WHERE orders.id = :idDonHang";

    $sth = $this->_connect->prepare($sql);
    $sth->execute(['idDonHang' => $id]);

    return $sth->fetch(PDO::FETCH_ASSOC);
}


    public function getDetailOrder(int $id){
        $sql = "SELECT * FROM `order_details`
            JOIN `products` ON `products`.`id` = `order_details`.`product_id`
            WHERE `order_details`.`order_id` = :idDonHang";

        $sth = $this->_connect->prepare($sql);
        $sth->execute([':idDonHang' => $id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithPagination(int $limit, int $offset)
    {
        $sql = "SELECT orders.*, users.name as user_name, users.email as user_email FROM $this->table 
                JOIN users ON users.id = orders.user_id 
                ORDER BY orders.created_at DESC 
                LIMIT :limit OFFSET :offset";
        $sth = $this->_connect->prepare($sql);
        $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function updateStatus(int $id, string $status)
    {
        $sql = "UPDATE $this->table SET status = :status, updated_at = NOW() WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->bindParam(':status', $status);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        return $sth->execute();
    }

    // Lấy đơn hàng theo user ID
    public function getOrdersByUserId(int $userId)
    {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY created_at DESC";
        $sth = $this->_connect->prepare($sql);
        $sth->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>

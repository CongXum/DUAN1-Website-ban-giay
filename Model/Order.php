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

}
?>

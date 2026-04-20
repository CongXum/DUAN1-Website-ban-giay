<?php 

class Cart{


    protected $table = "carts";
    protected $_connect;

    public function __construct($connect) {
        $this->_connect = $connect;
    }

    // Lấy tất cả
    public function getAll(int $user_id) {
        $sql = "SELECT * FROM $this->table  WHERE `user_id`= ?;";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 sản phẩm
    public function getOne($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($user_id, $product_id, $qty){

    // Kiểm tra đã tồn tại chưa
    $sql = "SELECT * FROM $this->table 
            WHERE user_id = ? AND product_id = ?";
    $sth = $this->_connect->prepare($sql);
    $sth->execute([$user_id, $product_id]);
    $item = $sth->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Nếu có rồi thì cộng thêm số lượng
        $sql = "UPDATE $this->table 
                SET qty = qty + ? 
                WHERE user_id = ? AND product_id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$qty, $user_id, $product_id]);
    } else {
        // Nếu chưa có thì thêm mới
        $sql = "INSERT INTO $this->table (user_id, product_id, qty) 
                VALUES (?, ?, ?)";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$user_id, $product_id, $qty]);
    }
}

    public function update ($qty ,$id){
    
        $sql = "UPDATE $this->table SET `qty`= ? WHERE `id`= ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$qty ,$id]);

    }

    public function delete ($id){
    
        $sql = "DELETE FROM $this->table WHERE `id` = ?;";

        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    
    }
}

    
?>
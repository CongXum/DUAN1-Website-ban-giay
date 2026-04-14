<?php

class User  {


    protected $table = "users";
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

    // Lấy 1 sản phẩm
    public function getOne($id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
?>

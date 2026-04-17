<?php
class Category {

    protected $table = "categories";
    protected $_connect;

    public function __construct($connect) {
        $this->_connect = $connect;
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // THÊM MỚI DANH MỤC
    public function insert($name) {
        $sql = "INSERT INTO $this->table (name) VALUES (:name)";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([':name' => $name]);
    }

    // CẬP NHẬT DANH MỤC
    public function update($id, $name) {
        $sql = "UPDATE $this->table SET name = :name WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([
            ':id' => $id,
            ':name' => $name
        ]);
    }

    // XÓA DANH MỤC
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([':id' => $id]);
    }
}
?>
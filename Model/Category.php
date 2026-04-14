<?php


class Category  {


    protected $table = "categories";
    protected $_connect;

    public function __construct($connect) {
        $this->_connect = $connect;
    }

    /**
     * Đây là phương thức lấy tất cả dữ liệu
     * @return array
     */
    public function getAll() {
        $sql = "SELECT * FROM $this->table ";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * đây là phương thức lấy 1 dữ liệu
     * @param int $id
     * @return array
     */
    public function getOne(int $id){
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

}
?>

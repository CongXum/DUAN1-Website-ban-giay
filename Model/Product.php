<?php

class Product {

    protected $table = "products";
    protected $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id){
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($title, $qty, $created_at, $images, $description, $price, $category_id){
        $sql = "INSERT INTO $this->table
        (title, qty, created_at, images, description, price, category_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([$title, $qty, $created_at, $images, $description, $price, $category_id]);
    }

    public function update($title, $qty, $created_at, $images, $description, $price, $category_id, $id){
        $sql = "UPDATE $this->table
        SET title=?, qty=?, created_at=?, images=?, description=?, price=?, category_id=?
        WHERE id=?";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([$title, $qty, $created_at, $images, $description, $price, $category_id, $id]);
    }

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE id=?";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([$id]);
    }

    public function getByCategory($category_id) {
    $sql = "SELECT * FROM $this->table WHERE category_id = ?";
    $sth = $this->_connect->prepare($sql);
    $sth->execute([$category_id]);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

public function getCategoryById($id) {
    $sql = "SELECT * FROM categories WHERE id = ?";
    $sth = $this->_connect->prepare($sql);
    $sth->execute([$id]);
    return $sth->fetch(PDO::FETCH_ASSOC);
}

    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getLatest($limit = 8)
{
    $limit = (int)$limit;
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT $limit";
    $sth = $this->_connect->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

}
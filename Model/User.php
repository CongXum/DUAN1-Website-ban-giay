<?php

class User
{


    protected $table = "users";
    protected $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    // Lấy tất cả
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table ";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 sản phẩm
    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($name, $email, $password, $phone, $address, $created_at, $updated_at)
    {

        $sql = " INSERT INTO $this->table( `name`, `email`, `password`, `phone`, `address`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?);";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $email, $password, $phone, $address, $created_at, $updated_at]);
    }

    public function update($name, $email, $password, $phone, $address, $created_at, $updated_at, $id)
    {

        $sql = "UPDATE $this->table
        SET `name`= ? ,`email`= ?,`password`= ?,`phone`= ?,`address`= ?,`created_at`= ?,`updated_at`= ? WHERE `id` = ?;";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $email, $password, $phone, $address, $created_at, $updated_at, $id]);
    }

    public function delete($id)
    {

        $sql = "DELETE FROM $this->table WHERE `id` = ?;";

        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }




    // Kiểm tra email đã tồn tại chưa
    public function checkEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':email' => $email]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // Đăng ký người dùng mới
    // Đăng ký người dùng mới
public function register($name, $email, $password, $phone, $address)
{
    // Xóa cột 'role' và giá trị '0' ở đây
    $sql = "INSERT INTO $this->table (name, email, password, phone, address) 
            VALUES (:name, :email, :password, :phone, :address)";
    
    $sth = $this->_connect->prepare($sql);
    return $sth->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
        ':phone' => $phone,
        ':address' => $address
    ]);
}
}

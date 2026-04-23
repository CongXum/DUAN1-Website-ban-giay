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
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = " INSERT INTO $this->table( `name`, `email`, `password`, `phone`, `address`, `created_at`, `updated_at`)
        VALUES (?,?,?,?,?,?,?);";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $email, $hashedPassword, $phone, $address, $created_at, $updated_at]);
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

    // Lấy danh sách người dùng với phân trang
    public function getAllWithPagination($limit, $offset)
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $sth = $this->_connect->prepare($sql);
        $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số người dùng
    public function countAll()
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Khóa tài khoản
    public function lockAccount($id)
    {
        $sql = "UPDATE $this->table SET status = 'locked' WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([':id' => $id]);
    }

    // Mở khóa tài khoản
    public function unlockAccount($id)
    {
        $sql = "UPDATE $this->table SET status = 'active' WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([':id' => $id]);
    }

    // Cập nhật thông tin người dùng (không bao gồm password)
    public function updateUser($name, $email, $phone, $address, $id)
    {
        $sql = "UPDATE $this->table SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $email, $phone, $address, $id]);
    }

    // Cập nhật thông tin người dùng bao gồm password
    public function updateUserWithPassword($name, $email, $phone, $address, $password, $id)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE $this->table SET name = ?, email = ?, phone = ?, address = ?, password = ? WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $email, $phone, $address, $hashedPassword, $id]);
    }

    // Lọc users với phân trang
    public function getFilteredUsers($limit, $offset, $role = null, $name = null, $email = null)
    {
        $sql = "SELECT * FROM $this->table WHERE 1=1";
        $params = [];

        if ($role !== null && $role !== '') {
            $sql .= " AND role = :role";
            $params[':role'] = $role;
        }

        if ($name !== null && $name !== '') {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $name . '%';
        }

        if ($email !== null && $email !== '') {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $email . '%';
        }

        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

        $sth = $this->_connect->prepare($sql);
        $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sth->bindParam(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $sth->bindValue($key, $value);
        }

        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm số lượng users đã lọc
    public function countFilteredUsers($role = null, $name = null, $email = null)
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table WHERE 1=1";
        $params = [];

        if ($role !== null && $role !== '') {
            $sql .= " AND role = :role";
            $params[':role'] = $role;
        }

        if ($name !== null && $name !== '') {
            $sql .= " AND name LIKE :name";
            $params[':name'] = '%' . $name . '%';
        }

        if ($email !== null && $email !== '') {
            $sql .= " AND email LIKE :email";
            $params[':email'] = '%' . $email . '%';
        }

        $sth = $this->_connect->prepare($sql);

        foreach ($params as $key => $value) {
            $sth->bindValue($key, $value);
        }

        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}

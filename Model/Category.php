<?php

class Category
{
    protected string $table = "categories";
    protected PDO $_connect;

    public function __construct(PDO $connect)
    {
        $this->_connect = $connect;
    }

    // Lấy tất cả danh mục
    public function getAll(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 danh mục
    public function getOne(int $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([':id' => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Thêm danh mục mới
     * @param string $name Tên danh mục
     * @param string $description Mô tả
     * @param string $image Đường dẫn hình ảnh
     * @param bool $status Trạng thái (true/false)
     * @return bool
     */
    public function insert(
        string $name, 
        string $description, 
        string $image, 
        bool $status
    ): bool {
        $sql = "INSERT INTO {$this->table} (`name`, `description`, `image`, `status`) 
                VALUES (?, ?, ?, ?);";

        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $description, $image, $status]);
    }

    /**
     * Cập nhật danh mục
     * @param string $name Tên danh mục
     * @param string $description Mô tả
     * @param string $image Đường dẫn hình ảnh
     * @param bool $status Trạng thái
     * @param int $id ID danh mục
     * @return bool
     */
    public function update(
        string $name, 
        string $description, 
        string $image, 
        bool $status, 
        int $id
    ): bool {
        $sql = "UPDATE {$this->table} 
                SET `name` = ?, `description` = ?, `image` = ?, `status` = ? 
                WHERE `id` = ?;";

        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $description, $image, $status, $id]);
    }

    /**
     * Xóa danh mục
     * @param int $id ID danh mục
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE `id` = ?;";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>

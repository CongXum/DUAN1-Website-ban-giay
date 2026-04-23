<?php

class BlogCategory
{
    private $conn;
    private $table = "blog_categories";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name)
    {
        $sql = "INSERT INTO {$this->table} (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $name
        ]);
    }

    public function update($id, $name)
    {
        $sql = "UPDATE {$this->table} SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

    public function existsName($name)
    {
        $sql = "SELECT id FROM {$this->table} WHERE name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name]);

        return $stmt->fetch() ? true : false;
    }

    public function existsNameExceptId($name, $id)
    {
        $sql = "SELECT id FROM {$this->table}
            WHERE name = ? AND id != ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$name, $id]);

        return $stmt->fetch() ? true : false;
    }

    public function countBlogs($category_id)
    {
        $sql = "SELECT COUNT(*) as total
            FROM blogs
            WHERE category_id = :category_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':category_id' => $category_id
        ]);

        return $stmt->fetch()['total'];
    }
}

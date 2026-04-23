<?php

class Comment
{
    private $conn;
    private $table = "comments";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // danh sách comment admin
    public function getAll($keyword = '', $status = '', $limit = 10, $offset = 0)
    {
        $sql = "SELECT comments.*,
               users.name AS user_name,
               products.title AS product_title
        FROM comments
        LEFT JOIN users ON users.id = comments.user_id
        LEFT JOIN products ON products.id = comments.product_id
        WHERE comments.is_deleted = 0";

        $params = [];

        if (!empty($keyword)) {

            $sql .= " AND (
        comments.content LIKE ?
        OR users.name LIKE ?
        OR products.title LIKE ?
    )";

            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
            $params[] = "%$keyword%";
        }

        if (!empty($status)) {
            $sql .= " AND comments.status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll($keyword = '', $status = '')
    {
        $sql = "SELECT COUNT(*) FROM $this->table WHERE is_deleted = 0";

        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND content LIKE ?";
            $params[] = "%$keyword%";
        }

        if (!empty($status)) {
            $sql .= " AND status = ?";
            $params[] = $status;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn();
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function approve($id)
    {
        $sql = "UPDATE $this->table SET status='approved' WHERE id=?";
        return $this->conn->prepare($sql)->execute([$id]);
    }

    public function reject($id)
    {
        $sql = "UPDATE $this->table SET status='rejected' WHERE id=?";
        return $this->conn->prepare($sql)->execute([$id]);
    }

    public function delete($id)
    {
        $sql = "UPDATE $this->table SET is_deleted=1 WHERE id=?";
        return $this->conn->prepare($sql)->execute([$id]);
    }
}

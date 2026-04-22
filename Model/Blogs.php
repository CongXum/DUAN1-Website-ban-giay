<?php
class Blog
{
    private $conn;
    private $table = 'blogs';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả bài viết
    public function getAll($limit, $offset, $status = null, $keyword = null)
    {
        $sql = "SELECT blogs.*, blog_categories.name AS category_name
            FROM blogs
            LEFT JOIN blog_categories 
            ON blogs.category_id = blog_categories.id
            WHERE 1=1";

        if ($status !== null && $status !== '') {
            $sql .= " AND blogs.status = :status";
        }

        if ($keyword !== null && $keyword !== '') {
            $sql .= " AND blogs.title LIKE :keyword";
        }

        $sql .= " ORDER BY blogs.id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);

        if ($status !== null && $status !== '') {
            $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        }

        if ($keyword !== null && $keyword !== '') {
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 bài viết
    public function getOne($id)
    {
        $sql = "SELECT blogs.*, blog_categories.name AS category_name
            FROM blogs
            LEFT JOIN blog_categories
            ON blogs.category_id = blog_categories.id
            WHERE blogs.id = :id
            LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm bài viết

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (title, slug, content, thumbnail, category_id, author, status, views) VALUES (:title, :slug, :content, :thumbnail,
        :category_id, :author, :status, 0)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':content' => $data['content'],
            ':thumbnail' => $data['thumbnail'] ?? null,
            ':category_id' => $data['category_id'] ?? null,
            ':author' => $data['author'],
            ':status' => $data['status'] ?? 0
        ]);
    }

    // Câp nhật bài viết
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET title = :title, slug = :slug, content = :content, thumbnail = :thumbnail,
        category_id = :category_id, author = :author, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':slug' => $data['slug'],
            ':content' => $data['content'],
            ':thumbnail' => $data['thumbnail'] ?? null,
            ':category_id' => $data['category_id'] ?? null,
            ':author' => $data['author'],
            ':status' => $data['status'] ?? 0
        ]);
    }

    // Xóa bài viết
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Tăng lượt xem
    public function incrementViews($id)
    {
        $sql = "UPDATE {$this->table} SET views = views + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // Tìm kiếm bài viết
    public function search($keyword)
    {
        $sql = "SELECT * FROM {$this->table} WHERE title LIKE :keyword ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':keyword' => "%$keyword%"
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existsTitle($title)
    {
        $sql = "SELECT id FROM blogs WHERE title = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title]);
        return $stmt->fetch() ? true : false;
    }

    public function existsTitleExceptId($title, $id)
    {
        $sql = "SELECT id FROM blogs WHERE title = ? AND id != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $id]);
        return $stmt->fetch() ? true : false;
    }
}

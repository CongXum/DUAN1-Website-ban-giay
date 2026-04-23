<?php

class BlogController
{
    private $blogModel;
    private $categoryModel;

    public function __construct($blogModel, $categoryModel)
    {
        $this->blogModel = $blogModel;
        $this->categoryModel = $categoryModel;
    }



    // Danh sách bài viết với phân trang, lọc trạng thái và tìm kiếm
    public function index()
    {
        $currentPage = $_GET['p'] ?? 1;

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $limit = 10;

        $offset = ($currentPage - 1) * $limit;

        $status = (isset($_GET['status']) && $_GET['status'] !== '')
            ? (int)$_GET['status']
            : null;

        $keyword = $_GET['keyword'] ?? null;


        // lấy tổng record
        $totalRecord = $this->blogModel->countAll($status, $keyword);


        // tính tổng page
        $totalPage = ceil($totalRecord / $limit);


        // nếu vượt page thì quay về page cuối
        if ($currentPage > $totalPage && $totalPage > 0) {
            $currentPage = $totalPage;
            $offset = ($currentPage - 1) * $limit;
        }


        // lấy dữ liệu
        $blogs = $this->blogModel->getAll($limit, $offset, $status, $keyword);


        require __DIR__ . '/../View/Modules/Blogs/Index.php';
    }

    // Cập nhật trạng thái hiển thị bài viết (AJAX)
    public function create()
    {
        $categories = $this->categoryModel->getAll();

        $errors = $_SESSION['form_errors'] ?? [];
        $old = $_SESSION['old'] ?? [];

        require __DIR__ . '/../View/Modules/Blogs/Create.php';
    }
    // Sửa bài viết
    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: ?page=blogs");
            exit;
        }

        $blog = $this->blogModel->getOne($id);
        $categories = $this->categoryModel->getAll();

        require __DIR__ . '/../View/Modules/Blogs/Edit.php';
    }

    // Xem chi tiết bài viết
    public function show()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = "Thiếu ID bài viết";
            header("Location: ?page=blogs");
            exit;
        }

        // Tăng lượt xem
        $this->blogModel->incrementViews($id);

        $blog = $this->blogModel->getOne($id);

        require __DIR__ . '/../View/Modules/Blogs/Show.php';
    }

    // Xoá bài viết
    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            $this->blogModel->delete($id);
            $_SESSION['success'] = "Xoá bài viết thành công";
        } else {
            $_SESSION['error'] = "ID không hợp lệ";
        }

        header("Location: ?page=blogs");
        exit;
    }

    // Tạo bài viết mới
    public function store($post, $files)
    {
        $errors = [];

        $title = trim($post['title'] ?? '');
        $content = trim($post['content'] ?? '');
        $author = trim($post['author'] ?? '');
        $category_id = (int)($post['category_id'] ?? 0);
        $status = (int)($post['status'] ?? 0);

        // Bắt lỗi
        if ($title === '') $errors['title'] = 'Tiêu đề không được để trống';
        if ($content === '') $errors['content'] = 'Nội dung không được để trống';
        if ($author === '') $errors['author'] = 'Tác giả không được để trống';
        if ($category_id <= 0) $errors['category_id'] = 'Chọn danh mục';

        // trùng tiêu đề
        if ($title !== '' && method_exists($this->blogModel, 'existsTitle')) {
            if ($this->blogModel->existsTitle($title)) {
                $errors['title'] = 'Tiêu đề đã tồn tại';
            }
        }

        // Bắt lỗi file ảnh
        if (!empty($files['thumbnail']['name'])) {
            $ext = strtolower(pathinfo($files['thumbnail']['name'], PATHINFO_EXTENSION));
            $allow = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $allow)) {
                $errors['thumbnail'] = 'File ảnh không hợp lệ';
            }

            if ($files['thumbnail']['size'] > 2 * 1024 * 1024) {
                $errors['thumbnail'] = 'Ảnh tối đa 2MB';
            }
        }

        // Nếu có lỗi, lưu lỗi và dữ liệu cũ vào session rồi quay lại form
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $post;

            session_write_close(); // thêm cái này cho chắc
            header("Location: ?page=create-blog");
            exit;
        }

        // Upload ảnh nếu có
        $thumbnail = '';
        if (!empty($files['thumbnail']['name'])) {
            $uploadDir = __DIR__ . '/../../public/Admin/Img/blogs/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $ext = pathinfo($files['thumbnail']['name'], PATHINFO_EXTENSION);
            $thumbnail = uniqid('blog_') . '.' . $ext;

            move_uploaded_file($files['thumbnail']['tmp_name'], $uploadDir . $thumbnail);
        }

        // Tạo slug từ tiêu đề
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

        // Lưu vào database
        $this->blogModel->create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'thumbnail' => $thumbnail,
            'category_id' => $category_id,
            'author' => $author,
            'status' => $status
        ]);
        session_regenerate_id(true);
        $_SESSION['success'] = "Thêm bài viết thành công";
        header("Location: ?page=blogs");
        exit;
    }

    // Cập nhật bài viết
    public function update($post, $files)
    {
        $id = (int)($post['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = "ID không hợp lệ";
            header("Location: ?page=blogs");
            exit;
        }

        $title = trim($post['title'] ?? '');
        $content = trim($post['content'] ?? '');
        $author = trim($post['author'] ?? '');
        $category_id = (int)($post['category_id'] ?? 0);
        $status = (int)($post['status'] ?? 0);

        $errors = [];

        if ($title === '') $errors['title'] = 'Tiêu đề không được để trống';
        if ($content === '') $errors['content'] = 'Nội dung không được để trống';
        if ($author === '') $errors['author'] = 'Tác giả không được để trống';

        // CHECK TRÙNG TITLE (loại trừ chính nó)
        if ($title !== '' && method_exists($this->blogModel, 'existsTitleExceptId')) {
            if ($this->blogModel->existsTitleExceptId($title, $id)) {
                $errors['title'] = 'Tiêu đề đã tồn tại';
            }
        }

        if (!empty($errors)) {

            $_SESSION['form_errors'] = $errors;
            $_SESSION['old'] = $post;

            header("Location: ?page=update-blog&id=$id");
            exit;
        }

        // IMAGE
        $thumbnail = $post['old_thumbnail'] ?? '';

        if (!empty($files['thumbnail']['name'])) {
            $uploadDir = __DIR__ . '/../../public/Admin/Img/blogs/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $ext = pathinfo($files['thumbnail']['name'], PATHINFO_EXTENSION);
            $thumbnail = uniqid('blog_') . '.' . $ext;

            move_uploaded_file($files['thumbnail']['tmp_name'], $uploadDir . $thumbnail);
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

        $this->blogModel->update($id, [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'thumbnail' => $thumbnail,
            'category_id' => $category_id,
            'author' => $author,
            'status' => $status
        ]);

        $_SESSION['success'] = "Cập nhật bài viết thành công";
        header("Location: ?page=blogs");
        exit;
    }
}

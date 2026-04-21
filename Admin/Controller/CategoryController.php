<?php

// =====================================================================
// XỬ LÝ CRUD DANH MỤC
// =====================================================================
if ($page === 'create-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $status  = (int)($_POST['status'] ?? 1);
    $content = trim($_POST['content'] ?? '');
    $image   = '';
    $today   = date('Y-m-d');

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../public/images/categories/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext   = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = uniqid('cat_') . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fname);
        $image = $fname;
    }

    if ($name) {
        $sql = "INSERT INTO categories (name, status, created_at, update_at, image, content)
                VALUES (?, ?, ?, ?, ?, ?)";
        $sth = $conn->prepare($sql);
        $sth->execute([$name, $status, $today, $today, $image, $content]);
        $_SESSION['success'] = 'Thêm danh mục thành công!';
    } else {
        $_SESSION['error'] = 'Tên danh mục không được để trống.';
    }
    header('Location: ?page=categories');
    exit;
}

if ($page === 'edit-category' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = (int)($_POST['id'] ?? 0);
    $name    = trim($_POST['name'] ?? '');
    $status  = (int)($_POST['status'] ?? 1);
    $content = trim($_POST['content'] ?? '');
    $image   = $_POST['old_image'] ?? '';
    $today   = date('Y-m-d');

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../public/images/categories/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext   = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fname = uniqid('cat_') . '.' . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fname);
        $image = $fname;
    }

    if ($id && $name) {
        $sql = "UPDATE categories SET name=?, status=?, update_at=?, image=?, content=? WHERE id=?";
        $sth = $conn->prepare($sql);
        $sth->execute([$name, $status, $today, $image, $content, $id]);
        $_SESSION['success'] = 'Cập nhật danh mục thành công!';
    } else {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
    }
    header('Location: ?page=categories');
    exit;
}

if ($page === 'delete-category') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id) {
        $categoryModel->delete($id);
        $_SESSION['success'] = 'Đã xóa danh mục!';
    }
    header('Location: ?page=categories');
    exit;
}

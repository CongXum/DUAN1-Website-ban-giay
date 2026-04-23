<?php

$page = $_GET['page'] ?? '';
if ($page === 'create-product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $qty         = (int)($_POST['qty'] ?? 0);
    $price       = (int)($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    $created_at  = date('Y-m-d');
    $images      = '';

    // Upload ảnh
    if (!empty($_FILES['images']['name'])) {
        $uploadDir = __DIR__ . '/../public/images/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext    = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
        $fname  = uniqid('prod_') . '.' . $ext;
        move_uploaded_file($_FILES['images']['tmp_name'], $uploadDir . $fname);
        $images = $fname;
    }

    if ($title && $price && $category_id) {
        $productModel->insert($title, $qty, $created_at, $images, $description, $price, $category_id);
        $_SESSION['success'] = 'Thêm sản phẩm thành công!';
    } else {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
    }
    header('Location: ?page=products');
    exit;
}

if ($page === 'update-product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = (int)($_POST['id'] ?? 0);
    $title       = trim($_POST['title'] ?? '');
    $qty         = (int)($_POST['qty'] ?? 0);
    $price       = (int)($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    $created_at  = $_POST['created_at'] ?? date('Y-m-d');
    $images      = $_POST['old_images'] ?? '';

    if (!empty($_FILES['images']['name'])) {
        $uploadDir = __DIR__ . '/../public/images/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext   = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
        $fname = uniqid('prod_') . '.' . $ext;
        move_uploaded_file($_FILES['images']['tmp_name'], $uploadDir . $fname);
        $images = $fname;
    }

    if ($id && $title && $price && $category_id) {
        $productModel->update($title, $qty, $created_at, $images, $description, $price, $category_id, $id);
        $_SESSION['success'] = 'Cập nhật sản phẩm thành công!';
    } else {
        $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
    }
    header('Location: ?page=products');
    exit;
}

if ($page === 'delete-product') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id) {
        $productModel->delete($id);
        $_SESSION['success'] = 'Đã xóa sản phẩm!';
    }
    header('Location: ?page=products');
    exit;
}
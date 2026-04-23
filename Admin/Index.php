<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Load models
require_once __DIR__ . '/../Model/Database.php';
require_once __DIR__ . '/../Model/Product.php';
require_once __DIR__ . '/../Model/Category.php';
require_once __DIR__ . '/../Model/Order.php';
require_once __DIR__ . '/../Model/Blogs.php';
require_once __DIR__ . '/../Model/BlogCategory.php';

// Load controllers
require_once __DIR__ . '/Controller/OrderController.php';
require_once __DIR__ . '/Controller/BlogController.php';

require_once __DIR__ . '/../Model/User.php'; // Thêm User model

// 2. Require các Controller
require_once __DIR__ . '/Controller/ProductController.php';
require_once __DIR__ . '/Controller/CategoryController.php'; // Đã thêm
require_once __DIR__ . '/Controller/UserController.php'; // Thêm User controller


$db   = new Database();
$conn = $db->connect();

$productModel  = new Product($conn);
$categoryModel = new Category($conn);
$blogModel = new Blog($conn);
$blogCategoryModel = new BlogCategory($conn);

$blogController = new BlogController($blogModel, $blogCategoryModel);

$page = $_GET['page'] ?? 'dashboard';

// =====================================================================
// XỬ LÝ CRUD SẢN PHẨM
// =====================================================================
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

// =====================================================================
// RENDER LAYOUT
// =====================================================================
include __DIR__ . '/View/Layouts/Header.php';
include __DIR__ . '/View/Layouts/Sidebar.php';
// 6. Khởi tạo Model và Controller cho Người dùng
$userModel = new User($conn);
$userController = new UserController($userModel);

// 6. Giao diện Header & Sidebar
include __DIR__ . '/View/layouts/Header.php';
include __DIR__ . '/View/layouts/Sidebar.php';
?>

<div class="content">
    <?php
    // Flash messages
    if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
            <i class="fa fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php unset($_SESSION['success']);
    endif;

    if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php unset($_SESSION['error']);
    endif; ?>

    <?php
    switch ($page) {
        case 'products':
            include 'View/Modules/Products/Index.php';
            break;
        case 'create-product':
            include 'View/Modules/Products/Create.php';
            break;
        case 'update-product':
            include 'View/Modules/Products/Update.php';
            break;
        case 'view-product':
            include 'View/Modules/Products/View.php';
            break;

        case 'categories':
            include 'View/Modules/Categories/Index.php';
            break;
        case 'create-category':
            include 'View/Modules/Categories/Create.php';
            break;
        case 'edit-category':
            include 'View/Modules/Categories/Edit.php';
            break;

        case 'users':
            include 'View/Modules/Users/Index.php';
            break;
        case 'orders':
            $controller = new OrderController($conn);
            $controller->index();
            break;

        case 'update-status':
            $controller = new OrderController($conn);
            $controller->updateStatus();
            break;
        case 'order-detail':
            $orderController = new OrderController($conn);
            $orderController->detail();
            break;
        case 'blogs':
            $blogController->index();
            break;

        case 'create-blog':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogController->store($_POST, $_FILES);
                exit;
            }

            $blogController->create();
            break;

        case 'update-blog':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $blogController->update($_POST, $_FILES);
                exit;
            }

            if (!isset($_GET['id'])) {
                $_SESSION['error'] = "Thiếu ID bài viết";
                header("Location: ?page=blogs");
                exit;
            }
    // ================= QUẢN LÝ NGƯỜI DÙNG =================
    case 'users':
        $userController->index();
        break;

    case 'user-create':
        $userController->create();
        break;

    case 'user-edit':
        $userController->edit();
        break;

    case 'user-delete':
        $userController->delete();
        break;

    case 'user-lock':
        $userController->lock();
        break;

    case 'user-unlock':
        $userController->unlock();
        break;

    case 'user-view':
        $userController->view();
        break;

    // ================= MẶC ĐỊNH =================
    default:
        echo "<h2>Dashboard</h2>";
        break;
}
?>

            $blogController->edit();
            break;


        case 'delete-blog':
            if (!isset($_GET['id'])) {
                $_SESSION['error'] = "Thiếu ID cần xoá";
                header("Location: ?page=blogs");
                exit;
            }

            $blogController->delete();
            exit;


        case 'view-blog':
            if (!isset($_GET['id'])) {
                $_SESSION['error'] = "Thiếu ID bài viết";
                header("Location: ?page=blogs");
                exit;
            }

            $blogController->show();
            break;
        case 'comments':
            include 'View/Modules/Comment/Index.php';
            break;
        case 'settings':
            include 'View/Modules/Settings/Index.php';
            break;
        default:
            include 'View/Modules/Dashboard/Index.php';
            break;
    }
    ?>
</div>

<?php include __DIR__ . '/View/Layouts/Footer.php'; ?>
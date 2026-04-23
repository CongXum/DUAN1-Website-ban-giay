<?php
class UserController
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $limit = 10; // Số bản ghi trên mỗi trang
        $offset = ($page - 1) * $limit;

        // Lấy các tham số lọc
        $role = isset($_GET['role']) ? $_GET['role'] : null;
        $name = isset($_GET['name']) ? trim($_GET['name']) : null;
        $email = isset($_GET['email']) ? trim($_GET['email']) : null;

        // Kiểm tra xem có bộ lọc nào được áp dụng không
        $hasFilters = ($role !== null && $role !== '') || ($name !== null && $name !== '') || ($email !== null && $email !== '');

        if ($hasFilters) {
            // Sử dụng phương thức lọc
            $users = $this->user->getFilteredUsers($limit, $offset, $role, $name, $email);
            $totalUsers = $this->user->countFilteredUsers($role, $name, $email);
        } else {
            // Sử dụng phương thức gốc
            $users = $this->user->getAllWithPagination($limit, $offset);
            $totalUsers = $this->user->countAll();
        }

        $totalPages = ceil($totalUsers / $limit);

        include __DIR__ . '/../View/Modules/Users/Index.php';
    }

    public function create()
    {
        if (isset($_POST['create'])) {

            $name     = trim($_POST['name'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $phone    = trim($_POST['phone'] ?? '');
            $address  = trim($_POST['address'] ?? '');
            $role     = $_POST['role'] ?? 0;

            $errors = [];

            $errors = [];

            // validate name
            if ($name === '') {
                $errors['name'] = "Tên không được để trống";
            }

            // validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ";
            }

            // validate password
            if (strlen($password) < 6) {
                $errors['password'] = "Mật khẩu phải từ 6 ký tự";
            }

            // check duplicate email
            if ($this->user->checkEmail($email)) {
                $errors['email'] = "Email đã tồn tại";
            }

            // ======================
            // HANDLE AVATAR UPLOAD
            // ======================
            $avatar = null;

            if (!empty($_FILES['avatar']['name'])) {

                $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
                $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));

                if (!in_array($ext, $allowedExt)) {
                    $errors[] = "Avatar phải là jpg, jpeg, png, webp";
                } else {

                    $uploadDir = __DIR__ . '/../../public/Admin/Img/products/';

                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $avatar = time() . '_' . uniqid() . '.' . $ext;

                    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $avatar)) {
                        $errors[] = "Upload avatar thất bại";
                    }
                }
            }

            // ======================
            // IF ERROR
            // ======================
            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);
                include __DIR__ . '/../View/Modules/Users/Create.php';
                return;
            }

            // ======================
            // INSERT DB
            // ======================
            $this->user->insert(
                $name,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $phone,
                $address,
                $role,
                $avatar
            );

            $_SESSION['success'] = "Tạo user thành công";

            header("Location: index.php?page=users");
            exit;
        }

        include __DIR__ . '/../View/Modules/Users/Create.php';
    }
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        if (!empty($_FILES['avatar']['name'])) {

            $avatar = time() . $_FILES['avatar']['name'];

            move_uploaded_file(

                $_FILES['avatar']['tmp_name'],

                "/public/Admin/Img/products" . $avatar

            );

            $this->user->updateAvatar($avatar, $id);
        }

        $user = $this->user->getOne($id);
        if (!$user) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $password = $_POST['password'];

            if (!empty($password)) {
                // Cập nhật với password mới
                $result = $this->user->updateUserWithPassword($name, $email, $phone, $address, $password, $id);
            } else {
                // Cập nhật không bao gồm password
                $result = $this->user->updateUser($name, $email, $phone, $address, $id);
            }

            if ($result) {
                header("Location: /Admin/index.php?page=users");
                exit;
            } else {
                $error = "Có lỗi xảy ra khi cập nhật!";
            }
        }

        include __DIR__ . '/../View/Modules/Users/Update.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Kiểm tra xem user có tồn tại không
        $user = $this->user->getOne($id);
        if (!$user) {
            // Có thể thêm thông báo lỗi ở đây
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Thực hiện xóa
        if ($this->user->delete($id)) {
            // Có thể thêm thông báo thành công ở đây
            header("Location: /Admin/index.php?page=users");
            exit;
        } else {
            // Có thể thêm thông báo lỗi ở đây
            header("Location: /Admin/index.php?page=users");
            exit;
        }
    }

    public function lock()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Kiểm tra xem user có tồn tại không
        $user = $this->user->getOne($id);
        if (!$user) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Thực hiện khóa
        if ($this->user->lockAccount($id)) {
            header("Location: /Admin/index.php?page=users");
            exit;
        } else {
            header("Location: /Admin/index.php?page=users");
            exit;
        }
    }

    public function unlock()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Kiểm tra xem user có tồn tại không
        $user = $this->user->getOne($id);
        if (!$user) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        // Thực hiện mở khóa
        if ($this->user->unlockAccount($id)) {
            header("Location: /Admin/index.php?page=users");
            exit;
        } else {
            header("Location: /Admin/index.php?page=users");
            exit;
        }
    }

    public function view()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        $user = $this->user->getOne($id);
        if (!$user) {
            header("Location: /Admin/index.php?page=users");
            exit;
        }

        include __DIR__ . '/../View/Modules/Users/View.php';
    }
}

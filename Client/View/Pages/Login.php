<?php
$error = "";

// Kiểm tra nếu người dùng nhấn nút Đăng Nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    // Gọi hàm checkEmail từ Model User để lấy thông tin user theo email
    $user = $userModel->checkEmail($email);

    if ($user) {
        // Kiểm tra mật khẩu (Sử dụng password_verify nếu bạn dùng password_hash khi đăng ký)
        if (password_verify($pass, $user['password'])) {

            session_regenerate_id(true); // 🔥 chống lỗi session cũ

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $_SESSION['user_id'] = $user['id']; // 🔥 đồng bộ luôn hệ thống cũ

            header("Location: index.php");
            exit();
        } else {
            $error = "Mật khẩu không chính xác!";
        }
    } else {
        $error = "Email này không tồn tại trong hệ thống!";
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 shadow-lg p-5 rounded bg-white">
            <h2 class="text-center mb-4 font-weight-bold" style="color: #2c3e50;">ĐĂNG NHẬP</h2>
            <hr>

            <?php if ($error): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php?page=login">
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" required>
                </div>

                <div class="form-group mb-4">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 p-3 mb-3" style="border-radius: 5px;">ĐĂNG NHẬP</button>

                <div class="text-center mt-3">
                    <span>Chưa có tài khoản? </span>
                    <a href="index.php?page=register" class="text-primary font-weight-bold">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</div>
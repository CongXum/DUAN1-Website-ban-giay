<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pass = $_POST['password'];
    $repass = $_POST['re-password'];

    // 1. Kiểm tra mật khẩu khớp nhau
    if ($pass !== $repass) {
        $msg = "<p class='alert alert-danger'>Mật khẩu nhập lại không khớp!</p>";
    } 
    // 2. Kiểm tra email đã tồn tại chưa
    elseif ($userModel->checkEmail($email)) {
        $msg = "<p class='alert alert-danger'>Email này đã được sử dụng!</p>";
    } 
    // 3. Tiến hành đăng ký
    else {
        if ($userModel->register($name, $email, $pass, $phone, $address)) {
            $msg = "<p class='alert alert-success'>Đăng ký thành công! <a href='index.php?page=login'>Đăng nhập ngay</a></p>";
        } else {
            $msg = "<p class='alert alert-danger'>Lỗi hệ thống, vui lòng thử lại.</p>";
        }
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 shadow-lg p-5 rounded bg-white">
            <h2 class="text-center mb-4 font-weight-bold" style="color: #2c3e50;">TẠO TÀI KHOẢN</h2>
            <hr>
            <?php echo $msg; ?>
            
            <form method="POST" action="index.php?page=register">
                <div class="form-group mb-3">
                    <label>Họ và tên</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập họ tên..." required>
                </div>
                
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                </div>

                <div class="form-group mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="090..." required>
                </div>
                
                <div class="form-group mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" placeholder="Tỉnh/Thành phố" required>
                </div>

                <div class="form-group mb-3">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>

                <div class="form-group mb-4">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="re-password" class="form-control" placeholder="******" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 p-3 mb-3" style="border-radius: 5px;">ĐĂNG KÝ NGAY</button>
                
                <div class="text-center">
                    <span>Bạn đã có tài khoản? </span><a href="index.php?page=login" class="text-primary font-weight-bold">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>
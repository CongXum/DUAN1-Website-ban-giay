<?php


/*
Sau này sẽ lấy từ database:

$user = getUserById($id);

*/

?>

<div class="container-fluid">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Cập nhật người dùng</h4>

            <a href="?page=users" class="btn btn-light">
                ← Quay lại danh sách
            </a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ tên</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= htmlspecialchars($user['name']) ?>"
                        required
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($user['email']) ?>"
                        required
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Không đổi thì bỏ trống"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                    >
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

            </div>

            <button type="submit" name="update" class="btn btn-warning">
                Cập nhật người dùng
            </button>

        </form>

    </div>

</div>
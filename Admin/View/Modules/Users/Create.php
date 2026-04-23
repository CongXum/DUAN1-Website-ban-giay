<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error'] ?>
    </div>
<?php unset($_SESSION['error']);
endif; ?>
<div class="container-fluid">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Thêm người dùng</h4>

            <a href="?page=users" class="btn btn-light">
                ← Quay lại danh sách
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="name" class="form-control">

                    <small class="text-danger"><?= $errors['name'] ?? '' ?></small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">

                    <small class="text-danger"><?= $errors['email'] ?? '' ?></small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">

                    <small class="text-danger"><?= $errors['password'] ?? '' ?></small>
                </div>

                <div class="col-md-6 mb-3">
                    <label>SĐT</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Vai trò</label>
                    <select name="role" class="form-select">

                        <option value="1">Admin</option>
                        <option value="0">User</option>

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>

            </div>

            <button name="create" class="btn btn-primary">
                Tạo user
            </button>

        </form>

    </div>

</div>
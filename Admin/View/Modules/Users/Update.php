<?php


/*
Sau này sẽ lấy từ database:

$user = getUserById($id);

*/

$user = [
    'name' => 'Nguyễn Văn A',
    'email' => 'admin@gmail.com',
    'role' => 'admin'
];

?>

<div class="container-fluid">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Cập nhật người dùng</h4>

            <a href="?page=users" class="btn btn-light">
                ← Quay lại danh sách
            </a>
        </div>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên người dùng</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= $user['name'] ?>"
                    >
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= $user['email'] ?>"
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

                    <label class="form-label">Vai trò</label>

                    <select name="role" class="form-select">

                        <option <?= $user['role']=="admin"?"selected":"" ?> value="admin">
                            Admin
                        </option>

                        <option <?= $user['role']=="user"?"selected":"" ?> value="user">
                            Khách hàng
                        </option>

                    </select>

                </div>

            </div>

            <button class="btn btn-warning">
                Cập nhật người dùng
            </button>

        </form>

    </div>

</div>
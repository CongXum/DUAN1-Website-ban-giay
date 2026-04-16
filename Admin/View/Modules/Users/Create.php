<div class="container-fluid">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Thêm người dùng</h4>

            <a href="?page=users" class="btn btn-light">
                ← Quay lại danh sách
            </a>
        </div>

        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên người dùng</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Vai trò</label>

                    <select name="role" class="form-select">
                        <option value="">Chọn vai trò</option>
                        <option value="admin">Admin</option>
                        <option value="user">Khách hàng</option>
                    </select>

                </div>

            </div>

            <button class="btn btn-primary">
                Lưu người dùng
            </button>

        </form>

    </div>

</div>
<div class="container-fluid">

    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Thêm người dùng</h4>

            <a href="?page=users" class="btn btn-light">
                ← Quay lại danh sách
            </a>
        </div>

        <           <input type="text" name="name" class="form-control" placeholder="Nhập họ tên" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Vai trò</label>
                    <select name="role" class="form-select" required>
                        <option value="user">Khách hàng</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <textarea name="address" class="form-control" placeholder="Nhập địa chỉ" rows="3"></textarea>
                </div>

            </div>

            <button type="submit" name="create" class="btn btn-primary">
                Tạo tài khoản
            </button>

        </form>

    </div>

</div>
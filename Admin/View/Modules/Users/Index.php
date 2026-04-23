<div class="container-fluid">

    <?php
    // Hàm helper để xây dựng URL với các tham số lọc
    function buildFilterUrl($params = []) {
        $query = ['page' => 'users'];
        if (isset($_GET['role']) && $_GET['role'] !== '') $query['role'] = $_GET['role'];
        if (isset($_GET['name']) && $_GET['name'] !== '') $query['name'] = $_GET['name'];
        if (isset($_GET['email']) && $_GET['email'] !== '') $query['email'] = $_GET['email'];

        // Ghi đè với params mới
        foreach ($params as $key => $value) {
            if ($value !== null && $value !== '') {
                $query[$key] = $value;
            } elseif (isset($query[$key])) {
                unset($query[$key]);
            }
        }

        return '?' . http_build_query($query);
    }
    ?>

    <div class="Products-card-box">

        <div class="Products-header">

            <h4>Danh sách người dùng</h4>

            <a href="?page=user-create" class="Products-btn-add">

                + Thêm người dùng

            </a>

        </div>

        <!-- Form lọc người dùng -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="" class="d-flex gap-3 align-items-end">
                    <input type="hidden" name="page" value="users">

                    <div class="flex-fill">
                        <label for="role" class="form-label">Vai trò</label>
                        <select name="role" id="role" class="form-select">
                            <option value="">Tất cả vai trò</option>
                            <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= (isset($_GET['role']) && $_GET['role'] == 'user') ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>

                    <div class="flex-fill">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên người dùng"
                               value="<?= isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
                    </div>

                    <div class="flex-fill">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Nhập email"
                               value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Lọc</button>
                        <a href="?page=users" class="btn btn-secondary ms-2">Xóa lọc</a>
                    </div>
                </form>
            </div>
        </div>

        <table class="Products-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>

                <tr>

                    <td><?= $user['id'] ?></td>

                    <td>

                        <img src="https://via.placeholder.com/60" class="Products-image">

                    </td>

                    <td>

                        <?= htmlspecialchars($user['name']) ?>

                    </td>

                    <td class="Products-category">

                        <?= htmlspecialchars($user['email']) ?>

                    </td>

                    <td>

                        <span class="Products-status Products-status-active">

                            <?= isset($user['role']) ? ucfirst(htmlspecialchars($user['role'])) : 'User' ?>

                        </span>

                    </td>

                    <td>

                        <?php if (isset($user['status']) && $user['status'] === 'locked'): ?>

                            <span class="Products-status Products-status-inactive">

                                Đã khóa

                            </span>

                        <?php else: ?>

                            <span class="Products-status Products-status-active">

                                Hoạt động

                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <div class="Products-actions">

                            <a href="?page=user-view&id=<?= $user['id'] ?>" class="Products-btn-view">

                                <i class="fa fa-eye"></i>

                            </a>

                            <a href="?page=user-edit&id=<?= $user['id'] ?>" class="Products-btn-edit">

                                <i class="fa fa-pen"></i>

                            </a>

                            <?php if (isset($user['status']) && $user['status'] === 'locked'): ?>

                                <a href="?page=user-unlock&id=<?= $user['id'] ?>" class="Products-btn-unlock" onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này?')">

                                    <i class="fa fa-unlock"></i>

                                </a>

                            <?php else: ?>

                                <a href="?page=user-lock&id=<?= $user['id'] ?>" class="Products-btn-lock" onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')">

                                    <i class="fa fa-lock"></i>

                                </a>

                            <?php endif; ?>

                            <a href="?page=user-delete&id=<?= $user['id'] ?>" class="Products-btn-delete" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">

                                <i class="fa fa-trash"></i>

                            </a>

                        </div>

                    </td>

                </tr>

                    <?php endforeach; ?>
                <?php else: ?>

                <tr>

                    <td colspan="7" style="text-align: center;">Không có người dùng nào</td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>

        <div class="pagination">

            <?php if ($page > 1): ?>

                <a href="<?= buildFilterUrl(['p' => $page - 1]) ?>" class="page-link">&laquo; Trước</a>

            <?php endif; ?>

            

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                <a href="<?= buildFilterUrl(['p' => $i]) ?>" class="page-link <?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>

            <?php endfor; ?>

            

            <?php if ($page < $totalPages): ?>

                <a href="<?= buildFilterUrl(['p' => $page + 1]) ?>" class="page-link">Sau &raquo;</a>

            <?php endif; ?>

        </div>

        <?php endif; ?>

    </div>

</div>
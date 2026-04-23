<div class="container-fluid">

    <?php
    function buildFilterUrl($params = [])
    {
        $query = ['page' => 'users'];
        if (isset($_GET['role']) && $_GET['role'] !== '') $query['role'] = $_GET['role'];
        if (isset($_GET['name']) && $_GET['name'] !== '') $query['name'] = $_GET['name'];
        if (isset($_GET['email']) && $_GET['email'] !== '') $query['email'] = $_GET['email'];

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
            <a href="?page=user-create" class="Products-btn-add">+ Thêm người dùng</a>
        </div>

        <!-- FILTER -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" class="d-flex gap-3 align-items-end">
                    <input type="hidden" name="page" value="users">

                    <div class="flex-fill">
                        <label class="form-label">Vai trò</label>
                        <select name="role" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="1" <?= ($_GET['role'] ?? '') == '1' ? 'selected' : '' ?>>Admin</option>
                            <option value="0" <?= ($_GET['role'] ?? '') == '0' ? 'selected' : '' ?>>Người dùng</option>
                        </select>
                    </div>

                    <div class="flex-fill">
                        <label class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control"
                            value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
                    </div>

                    <div class="flex-fill">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control"
                            value="<?= htmlspecialchars($_GET['email'] ?? '') ?>">
                    </div>

                    <div>
                        <button class="btn btn-primary">Lọc</button>
                        <a href="?page=users" class="btn btn-secondary">Xóa</a>
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
                <?php foreach ($users as $user): ?>

                    <?php
                    $roleText = ($user['role'] == 1) ? 'Admin' : 'Người dùng';
                    $roleClass = ($user['role'] == 1) ? 'role-admin' : 'role-user';
                    ?>


                    <tr>
                        <td><?= $user['id'] ?></td>

                        <td>
                            <img src="../public/Admin/Img/products/<?= $user['avatar'] ?? 'default.png' ?>"
                                class="Products-image">
                        </td>

                        <td><?= htmlspecialchars($user['name']) ?></td>

                        <td><?= htmlspecialchars($user['email']) ?></td>

                        <!-- ✅ ROLE FIX -->
                        <td>
                            <span class="Products-status Products-status-active <?= $roleClass ?>">
                                <?= $roleText ?>
                            </span>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php if ($user['status'] === 'locked'): ?>
                                <span class="Products-status Products-status-inactive">Đã khóa</span>
                            <?php else: ?>
                                <span class="Products-status Products-status-active">Hoạt động</span>
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

                                <?php if ($user['status'] === 'locked'): ?>
                                    <a href="?page=user-unlock&id=<?= $user['id'] ?>" class="Products-btn-unlock">
                                        <i class="fa fa-unlock"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="?page=user-lock&id=<?= $user['id'] ?>" class="Products-btn-lock">
                                        <i class="fa fa-lock"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="?page=user-delete&id=<?= $user['id'] ?>" class="Products-btn-delete">
                                    <i class="fa fa-trash"></i>
                                </a>

                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
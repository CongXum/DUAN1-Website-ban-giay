<div class="container-fluid">

    <div class="Products-card-box">

        <div class="Products-header">

            <h4>Chi tiết người dùng</h4>

            <div class="Products-actions">

                <a href="?page=user-edit&id=<?= $_GET['id'] ?>"
                    class="Products-btn-edit">

                    <i class="fa fa-pen"></i>

                </a>

                <a href="?page=users"
                    class="Products-btn-view">

                    <i class="fa fa-arrow-left"></i>

                </a>

            </div>

        </div>


        <div class="User-view-wrapper">


            <div class="User-avatar-section">

                <img
                    src="https://via.placeholder.com/120"
                    class="User-avatar-large">

                <h5><?= htmlspecialchars($user['name']) ?></h5>

                <span class="Products-status Products-status-active">

                    <?= isset($user['role']) ? ucfirst(htmlspecialchars($user['role'])) : 'User' ?>

                </span>

            </div>



            <div class="User-info-grid">


                <div class="User-info-item">

                    <label>ID</label>

                    <p><?= $user['id'] ?></p>

                </div>


                <div class="User-info-item">

                    <label>Email</label>

                    <p><?= htmlspecialchars($user['email']) ?></p>

                </div>


                <div class="User-info-item">

                    <label>Số điện thoại</label>

                    <p><?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?></p>

                </div>


                <div class="User-info-item">

                    <label>Địa chỉ</label>

                    <p><?= htmlspecialchars($user['address'] ?? 'Chưa cập nhật') ?></p>

                </div>
                <div class="User-info-item">
                    <label>Vai trò</label>
                    <span class="Admin-role-badge Admin-role-admin">
                        <?= isset($user['role']) ? ucfirst(htmlspecialchars($user['role'])) : 'User' ?>
                    </span>
                </div>

                <div class="User-info-item">

                    <label>Trạng thái</label>

                    <?php if (isset($user['status']) && $user['status'] === 'locked'): ?>

                        <span class="Products-status Products-status-inactive">

                            Đã khóa

                        </span>

                    <?php else: ?>

                        <span class="Products-status Products-status-active">

                            Hoạt động

                        </span>

                    <?php endif; ?>

                </div>


                <div class="User-info-item">

                    <label>Ngày tạo</label>

                    <p><?= isset($user['created_at']) ? date('d/m/Y', strtotime($user['created_at'])) : 'N/A' ?></p>

                </div>



            </div>


        </div>

    </div>

</div>
<div class="container-fluid">

    <div class="Products-card-box">

        <div class="Products-header">

            <h4>Danh sách người dùng</h4>

            <a href="?page=create-user" class="Products-btn-add">

                + Thêm người dùng

            </a>

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

                <?php for ($i = 1; $i <= 5; $i++): ?>

                <tr>

                    <td><?= $i ?></td>

                    <td>

                        <img src="https://via.placeholder.com/60" class="Products-image">

                    </td>

                    <td>

                        Nguyễn Văn <?= $i ?>

                    </td>

                    <td class="Products-category">

                        user<?= $i ?>@gmail.com

                    </td>

                    <td>

                        <span class="Products-status Products-status-active">

                            Admin

                        </span>

                    </td>

                    <td>

                        <span class="Products-status Products-status-active">

                            Hoạt động

                        </span>

                    </td>

                    <td>

                        <div class="Products-actions">

                            <a href="?page=view-user&id=<?= $i ?>" class="Products-btn-view">

                                <i class="fa fa-eye"></i>

                            </a>

                            <a href="?page=update-user&id=<?= $i ?>" class="Products-btn-edit">

                                <i class="fa fa-pen"></i>

                            </a>

                            <button class="Products-btn-delete">

                                <i class="fa fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                <?php endfor; ?>

            </tbody>

        </table>

    </div>

</div>
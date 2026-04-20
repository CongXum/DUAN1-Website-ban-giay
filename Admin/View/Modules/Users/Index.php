<div class="container-fluid">

    <div class="Us-card-box">

        <div class="Products-header">

            <h4>Danh sách người dùng</h4>

            <a href="?page=create-user" class="Products-btn-add">

                + Thêm người dùng

            </a>

        </div>

        <div class="Products-toolbar">


            <form method="GET" class="Products-filter-form">

                <input type="hidden" name="page" value="users">


                <select name="role" class="Products-select">

                    <option value="">-- Vai trò --</option>

                    <option value="admin"
                        <?= ($_GET['role'] ?? '') == 'admin' ? 'selected' : '' ?>>
                        Admin
                    </option>

                    <option value="staff"
                        <?= ($_GET['role'] ?? '') == 'staff' ? 'selected' : '' ?>>
                        Staff
                    </option>

                    <option value="customer"
                        <?= ($_GET['role'] ?? '') == 'customer' ? 'selected' : '' ?>>
                        Customer
                    </option>

                </select>



                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm tên hoặc email..."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    class="Products-search-input">



                <button class="Products-btn-filter">

                    <i class="fa fa-search"></i>

                    Lọc

                </button>

            </form>


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

        <div class="Products-pagination">


            <a href="?page=users&p=1"
                class="Products-page-btn">

                «

            </a>


            <?php for ($i = 1; $i <= 5; $i++): ?>
                <a
                    href="?page=users
                    &p=<?= $i ?>
                    &role=<?= $_GET['role'] ?? '' ?>
                    &keyword=<?= $_GET['keyword'] ?? '' ?>"
                    class="Products-page-btn
                    <?= ($_GET['p'] ?? 1) == $i ? 'active' : '' ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>


            <a href="?page=users&p=5"
                class="Products-page-btn">

                »

            </a>


        </div>

    </div>

</div>
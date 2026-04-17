<div class="container-fluid">

    <div class="Category-card-box">


        <div class="Category-header">

            <h4><strong>Danh sách danh mục</strong></h4>

            <a href="?page=create-category"
                class="Category-btn-add">

                + Thêm danh mục

            </a>

        </div>



        <!-- TOOLBAR -->

        <div class="Category-toolbar">

            <form method="GET"
                class="Category-filter-form">

                <input type="hidden"
                    name="page"
                    value="categories">


                <select name="status"
                    class="Category-select">

                    <option value="">-- Trạng thái --</option>

                    <option value="active"
                        <?= ($_GET['status'] ?? '') == 'active' ? 'selected' : '' ?>>
                        Hoạt động
                    </option>

                    <option value="hidden"
                        <?= ($_GET['status'] ?? '') == 'hidden' ? 'selected' : '' ?>>
                        Ẩn
                    </option>

                </select>



                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm tên danh mục..."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    class="Category-search-input">


                <button class="Category-btn-filter">

                    <i class="fa fa-search"></i>
                    Lọc

                </button>

            </form>

        </div>



        <!-- TABLE -->

        <table class="Category-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>


            <tbody>

                <?php for ($i = 1; $i <= 5; $i++): ?>

                    <tr>

                        <td><?= $i ?></td>

                        <td>Danh mục <?= $i ?></td>

                        <td class="Category-description">

                            Danh mục sản phẩm thể thao

                        </td>

                        <td>

                            <span class="Category-status Category-status-active">

                                Hoạt động

                            </span>

                        </td>

                        <td>

                            <div class="Category-actions">



                                <a href="?page=edit-category&id=<?= $i ?>"
                                    class="Category-btn-edit">

                                    <i class="fa fa-pen"></i>

                                </a>


                                <button class="Category-btn-delete">

                                    <i class="fa fa-trash"></i>

                                </button>


                            </div>

                        </td>

                    </tr>

                <?php endfor; ?>

            </tbody>

        </table>



        <!-- PAGINATION -->

        <div class="Category-pagination">


            <?php for ($i = 1; $i <= 5; $i++): ?>

                <a
                    href="?page=categories
                    &p=<?= $i ?>
                    &status=<?= $_GET['status'] ?? '' ?>
                    &keyword=<?= $_GET['keyword'] ?? '' ?>"
                    class="Category-page-btn
                    <?= ($_GET['p'] ?? 1) == $i ? 'active' : '' ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>


        </div>


    </div>

</div>
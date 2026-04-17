<div class="container-fluid">

    <div class="Blog-card-box">

        <!-- HEADER -->

        <div class="Blog-header">

            <h4><strong>Danh sách bài viết</strong></h4>

            <a href="?page=create-blog"
                class="Blog-btn-add">

                + Thêm bài viết

            </a>

        </div>


        <!-- TOOLBAR -->

        <div class="Blog-toolbar">

            <form method="GET"
                class="Blog-filter-form">

                <input type="hidden"
                    name="page"
                    value="blogs">


                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm tiêu đề bài viết..."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    class="Blog-search-input">


                <select name="status"
                    class="Blog-select">

                    <option value="">-- Trạng thái --</option>

                    <option value="active"
                        <?= ($_GET['status'] ?? '') == 'active' ? 'selected' : '' ?>>
                        Hiển thị
                    </option>

                    <option value="hidden"
                        <?= ($_GET['status'] ?? '') == 'hidden' ? 'selected' : '' ?>>
                        Ẩn
                    </option>

                </select>


                <button class="Blog-btn-filter">

                    <i class="fa fa-search"></i>
                    Lọc

                </button>

            </form>

        </div>



        <!-- TABLE -->

        <table class="Blog-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>


            <tbody>

                <?php for ($i = 1; $i <= 6; $i++): ?>

                    <tr>

                        <td><?= $i ?></td>


                        <td>

                            <img
                                src="https://picsum.photos/80?random=<?= $i ?>"
                                class="Blog-image">

                        </td>


                        <td class="Blog-title">

                            Top giày thể thao hot <?= $i ?>

                        </td>


                        <td class="Blog-description">

                            Xu hướng giày sneaker mới nhất năm 2026 dành cho giới trẻ năng động...

                        </td>


                        <td>

                            <span class="Blog-status Blog-status-active">

                                Hiển thị

                            </span>

                        </td>


                        <td>

                            <div class="Blog-actions">


                                <a href="?page=view-blog&id=<?= $i ?>"
                                    class="Blog-btn-view">

                                    <i class="fa fa-eye"></i>

                                </a>


                                <a href="?page=edit-blog&id=<?= $i ?>"
                                    class="Blog-btn-edit">

                                    <i class="fa fa-pen"></i>

                                </a>


                                <button class="Blog-btn-delete">

                                    <i class="fa fa-trash"></i>

                                </button>


                            </div>

                        </td>

                    </tr>

                <?php endfor; ?>

            </tbody>

        </table>



        <!-- PAGINATION -->

        <div class="Blog-pagination">

            <?php for ($i = 1; $i <= 5; $i++): ?>

                <a
                    href="?page=blogs
                    &p=<?= $i ?>
                    &keyword=<?= $_GET['keyword'] ?? '' ?>
                    &status=<?= $_GET['status'] ?? '' ?>"
                    class="Blog-page-btn
                    <?= ($_GET['p'] ?? 1) == $i ? 'active' : '' ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>

        </div>


    </div>

</div>
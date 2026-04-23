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


                <select name="status" class="Blog-select">
                    <option value="">-- Trạng thái --</option>

                    <option value="1" <?= ($_GET['status'] ?? '') == '1' ? 'selected' : '' ?>>
                        Hiển thị
                    </option>

                    <option value="0" <?= ($_GET['status'] ?? '') == '0' ? 'selected' : '' ?>>
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
                    <th style="width: 10px;">Tiêu đề</th>
                    <th style="width: auto;">Mô tả</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $index => $blog): ?>

                        <tr>

                            <td><?= $offset + $index + 1 ?></td>

                            <td>
                                <img src="../public/Admin/Img/blogs/<?= $blog['thumbnail'] ?>"
                                    class="Blog-image">
                            </td>

                            <td class="Blog-title">
                                <?= htmlspecialchars($blog['title']) ?>
                            </td>

                            <td class="Blog-description">
                                <?= mb_substr(strip_tags($blog['content']), 0, 80) ?>...
                            </td>
                            <td>

                                <span class="Blog-category-badge">
                                    <?= $blog['category_name'] ?>
                                </span>

                            </td>

                            <td>
                                <?php if ($blog['status'] == 1): ?>
                                    <span class="Blog-status Blog-status-active">Hiển thị</span>
                                <?php else: ?>
                                    <span class="Blog-status">Ẩn</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="Blog-actions">

                                    <a href="?page=view-blog&id=<?= $blog['id'] ?>"
                                        class="Blog-btn-view">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="?page=update-blog&id=<?= $blog['id'] ?>"
                                        class="Blog-btn-edit">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                    <a href="?page=delete-blog&id=<?= $blog['id'] ?>"
                                        onclick="return confirm('Xóa bài viết này?')"
                                        class="Blog-btn-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Không có bài viết</td>
                    </tr>
                <?php endif; ?>

            </tbody>

        </table>



        <!-- PAGINATION -->

        <?php if ($totalPage > 1): ?>

            <div class="Blog-pagination">

                <?php for ($i = 1; $i <= $totalPage; $i++): ?>

                    <a href="?page=blogs&p=<?= $i ?>&keyword=<?= $_GET['keyword'] ?? '' ?>&status=<?= $_GET['status'] ?? '' ?>"
                        class="Blog-page-btn <?= ($currentPage == $i) ? 'active' : '' ?>">

                        <?= $i ?>

                    </a>

                <?php endfor; ?>

            </div>

        <?php endif; ?>



    </div>


</div>

<hr>
<?php if (!empty($_SESSION['success'])): ?>

    <div class="BlogCategory-toast BlogCategory-toast-success">

        <?= $_SESSION['success'] ?>

    </div>

    <?php unset($_SESSION['success']); ?>

<?php endif ?>


<?php if (!empty($_SESSION['error'])): ?>

    <div class="BlogCategory-toast BlogCategory-toast-error">

        <?= $_SESSION['error'] ?>

    </div>

    <?php unset($_SESSION['error']); ?>

<?php endif ?>

<div class="BlogCategory-wrapper">

    <div class="BlogCategory-header">

        <h4>Danh mục bài viết</h4>

    </div>


    <form method="POST"
        action="?page=create-blog-category"
        class="BlogCategory-create-form">

        <input type="text"
            name="name"
            placeholder="Nhập tên danh mục..."
            class="BlogCategory-input">

        <button class="BlogCategory-btn-add">

            Thêm danh mục

        </button>

    </form>



    <table class="BlogCategory-table">

        <thead>

            <tr>

                <th width="80">STT</th>

                <th>Tên danh mục</th>

                <th width="120">Số bài viết</th>

                <th width="200">Hành động</th>

            </tr>

        </thead>


        <tbody>

            <?php foreach ($categories as $index => $category): ?>

                <tr>

                    <td>

                        <?= $index + 1 ?>

                    </td>


                    <td>

                        <form method="POST"
                            action="?page=update-blog-category"
                            style="display:flex; gap:6px;">

                            <input type="hidden"
                                name="id"
                                value="<?= $category['id'] ?>">


                            <input type="text"
                                name="name"
                                value="<?= htmlspecialchars($category['name']) ?>"
                                class="BlogCategory-edit-input">


                            <button class="BlogCategory-btn-edit">

                                Sửa

                            </button>

                        </form>

                    </td>


                    <td>

                        <span class="BlogCategory-count">

                            <?= $category['blog_count'] ?>

                        </span>

                    </td>


                    <td>

                        <?php if ($category['blog_count'] > 0): ?>

                            <button
                                class="BlogCategory-btn-delete"
                                disabled
                                title="Không thể xoá vì có bài viết">

                                Đang sử dụng

                            </button>

                        <?php else: ?>

                            <a href="?page=delete-blog-category&id=<?= $category['id'] ?>"
                                onclick="return confirm('Xóa danh mục này?')">

                                <button class="BlogCategory-btn-delete">

                                    Xóa

                                </button>

                            </a>

                        <?php endif ?>

                    </td>

                </tr>

            <?php endforeach ?>

        </tbody>

    </table>

</div>

<script>
    setTimeout(() => {

        const toast = document.querySelector(".BlogCategory-toast");

        if (toast) {

            toast.style.transition = "0.4s";

            toast.style.opacity = "0";

            toast.style.transform = "translateX(120%)";

        }

    }, 3000);
</script>
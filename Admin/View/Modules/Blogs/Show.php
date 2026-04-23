<div class="container-fluid">

    <div class="Blog-card-box">

        <div class="Blog-header">

            <h4><strong>Chi tiết bài viết</strong></h4>

            <div>

                <a href="?page=update-blog&id=<?= $blog['id'] ?>"
                    class="Blog-btn-add"
                    style="background:#ffc107; margin-right:8px;">

                    <i class="bi bi-pencil-square"></i> Sửa

                </a>

                <a href="?page=blogs"
                    class="Blog-btn-add"
                    style="background:#6c757d;">
                    ← Quay lại
                </a>

            </div>

        </div>


        <div class="Blog-grid">

            <!-- TITLE -->
            <div class="Blog-group full">

                <label>Tiêu đề</label>

                <p><?= htmlspecialchars($blog['title']) ?></p>

            </div>


            <!-- AUTHOR -->
            <div class="Blog-group">

                <label>Tác giả</label>

                <p><?= htmlspecialchars($blog['author']) ?></p>

            </div>


            <!-- CATEGORY -->
            <div class="Blog-group">

                <label>Danh mục</label>

                <p><?= htmlspecialchars($blog['category_name']) ?></p>

            </div>


            <!-- STATUS -->
            <div class="Blog-group">

                <label>Trạng thái</label>

                <p>

                    <?php if ($blog['status']) : ?>

                        <span style="color:green; font-weight:bold;">
                            Hiển thị
                        </span>

                    <?php else : ?>

                        <span style="color:red; font-weight:bold;">
                            Ẩn
                        </span>

                    <?php endif; ?>

                </p>

            </div>


            <!-- VIEWS -->
            <div class="Blog-group">

                <label>Lượt xem</label>

                <p><?= $blog['views'] ?></p>

            </div>


            <!-- CREATED -->
            <?php if (!empty($blog['created_at'])) : ?>

                <div class="Blog-group">

                    <label>Ngày tạo</label>

                    <p><?= $blog['created_at'] ?></p>

                </div>

            <?php endif; ?>


            <!-- THUMBNAIL -->
            <?php if (!empty($blog['thumbnail'])) : ?>

                <div class="Blog-group full">

                    <label>Ảnh đại diện</label>

                    <img
                        src="../public/Admin/Img/blogs/<?= $blog['thumbnail'] ?>"
                        style="max-width:300px;
                               border-radius:8px;
                               box-shadow:0 2px 6px rgba(0,0,0,.2);">

                </div>

            <?php endif; ?>


            <!-- CONTENT -->
            <div class="Blog-group full">

                <label>Nội dung</label>

                <div style="
                    background:#fff;
                    padding:20px;
                    border-radius:8px;
                    border:1px solid #eee;
                ">

                    <?= $blog['content'] ?>

                </div>

            </div>

        </div>

    </div>

</div>
<?php
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['old'] ?? [];
?>

<div class="container-fluid">

    <div class="Blog-card-box">

        <div class="Blog-header">
            <h4><strong>Cập nhật bài viết</strong></h4>

            <a href="?page=blogs"
                class="Blog-btn-add"
                style="background:#6c757d;">
                ← Quay lại
            </a>
        </div>

        <form method="POST"
            action="?page=update-blog"
            enctype="multipart/form-data"
            class="Blog-form">

            <input type="hidden"
                name="id"
                value="<?= $blog['id'] ?>">

            <input type="hidden"
                name="old_thumbnail"
                value="<?= $blog['thumbnail'] ?>">

            <div class="Blog-grid">

                <!-- TITLE -->
                <div class="Blog-group">
                    <label>Tiêu đề</label>

                    <input type="text"
                        name="title"
                        value="<?= htmlspecialchars($old['title'] ?? $blog['title']) ?>"
                        class="Blog-input">
                    <?php if (!empty($errors['title'])): ?>
                        <small style="color:red"><?= $errors['title'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- AUTHOR -->
                <div class="Blog-group">
                    <label>Tác giả</label>

                    <input type="text"
                        name="author"
                        value="<?= htmlspecialchars($old['author'] ?? $blog['author']) ?>"
                        class="Blog-input">
                    <?php if (!empty($errors['author'])): ?>
                        <small style="color:red"><?= $errors['author'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- CATEGORY -->
                <div class="Blog-group">
                    <label>Danh mục</label>

                    <select name="category_id"
                        class="Blog-select">

                        <?php foreach ($categories as $cat): ?>

                            <option value="<?= $cat['id'] ?>"
                                <?= (($old['category_id'] ?? $blog['category_id']) == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>
                    <?php if (!empty($errors['category_id'])): ?>
                        <small style="color:red"><?= $errors['category_id'] ?></small>
                    <?php endif; ?>

                </div>

                <!-- STATUS -->
                <div class="Blog-group">
                    <label>Trạng thái</label>

                    <select name="status" class="Blog-select">

                        <option value="1"
                            <?= (($old['status'] ?? $blog['status']) == 1) ? 'selected' : '' ?>>
                            Hiển thị
                        </option>

                        <option value="0"
                            <?= (($old['status'] ?? $blog['status']) == 0) ? 'selected' : '' ?>>
                            Ẩn
                        </option>

                    </select>
                </div>

                <!-- CONTENT -->
                <div class="Blog-group full">
                    <label>Nội dung</label>

                    <textarea name="content"
                        class="Blog-textarea"><?= htmlspecialchars($old['content'] ?? $blog['content']) ?></textarea>

                    <?php if (!empty($errors['content'])): ?>
                        <small style="color:red"><?= $errors['content'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- THUMBNAIL -->
                <div class="Blog-group full">

                    <label>Ảnh hiện tại</label>

                    <?php if ($blog['thumbnail']) : ?>

                        <img src="../public/Admin/Img/blogs/<?= $blog['thumbnail'] ?>"
                            style="width:150px;
                            display:block;
                            margin-bottom:10px;">

                    <?php endif; ?>

                    <label>Đổi ảnh mới</label>

                    <input type="file"
                        name="thumbnail"
                        class="Blog-input"
                        accept="image/*"
                        onchange="previewThumbnail(event)">

                    <br>

                    <img id="preview-thumbnail"
                        src="../public/Admin/Img/blogs/<?= $blog['thumbnail'] ?>"
                        style="width:150px; margin-top:10px;">

                </div>

            </div>

            <button type="submit"
                class="Blog-btn-submit">

                Cập nhật bài viết

            </button>

        </form>

        <?php
        unset($_SESSION['form_errors'], $_SESSION['old']);
        ?>
    </div>

</div>
<?php
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['old'] ?? [];
?>

<div class="container-fluid">

    <div class="Blog-card-box">

        <div class="Blog-header">
            <h4><strong>Thêm bài viết</strong></h4>

            <a href="?page=blogs" class="Blog-btn-add" style="background:#6c757d;">
                ← Quay lại
            </a>
        </div>

        <form method="POST"
            action="?page=create-blog"
            enctype="multipart/form-data"
            class="Blog-form">

            <div class="Blog-grid">

                <!-- TITLE -->
                <div class="Blog-group">
                    <label>Tiêu đề</label>

                    <input type="text"
                        name="title"
                        value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                        class="Blog-input">

                    <?php if (!empty($errors['title'])): ?>
                        <small style="color:red;"><?= $errors['title'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- AUTHOR -->
                <div class="Blog-group">
                    <label>Tác giả</label>

                    <input type="text"
                        name="author"
                        value="<?= htmlspecialchars($old['author'] ?? '') ?>"
                        class="Blog-input">

                    <?php if (!empty($errors['author'])): ?>
                        <small style="color:red;"><?= $errors['author'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- CATEGORY -->
                <div class="Blog-group">
                    <label>Danh mục</label>

                    <select name="category_id" class="Blog-select">
                        <option value="">-- Chọn danh mục --</option>

                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= (isset($old['category_id']) && $old['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (!empty($errors['category_id'])): ?>
                        <small style="color:red;"><?= $errors['category_id'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- STATUS -->
                <div class="Blog-group">
                    <label>Trạng thái</label>

                    <select name="status" class="Blog-select">
                        <option value="1" <?= ($old['status'] ?? 1) == 1 ? 'selected' : '' ?>>
                            Hiển thị
                        </option>

                        <option value="0" <?= ($old['status'] ?? 0) == 0 ? 'selected' : '' ?>>
                            Ẩn
                        </option>
                    </select>
                </div>

                <!-- CONTENT -->
                <div class="Blog-group full">
                    <label>Nội dung</label>

                    <textarea name="content"
                        class="Blog-textarea"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>

                    <?php if (!empty($errors['content'])): ?>
                        <small style="color:red;"><?= $errors['content'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- THUMBNAIL -->
                <div class="Blog-group full">
                    <label>Ảnh đại diện</label>

                    <input type="file"
                        name="thumbnail"
                        class="Blog-input"
                        accept="image/*"
                        onchange="previewThumbnail(event)">

                    <br>

                    <img id="preview-thumbnail"
                        style="width:150px; margin-top:10px; display:none;">

                    <?php if (!empty($errors['thumbnail'])): ?>
                        <small style="color:red;"><?= $errors['thumbnail'] ?></small>
                    <?php endif; ?>
                </div>

            </div>

            <button type="submit" class="Blog-btn-submit">
                Lưu bài viết
            </button>

        </form>
        <?php
        unset($_SESSION['form_errors'], $_SESSION['old']);
        ?>
    </div>
</div>
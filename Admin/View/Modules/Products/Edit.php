<h3 class="mb-3">Cập nhật sản phẩm</h3>

<form method="POST" enctype="multipart/form-data">

    <div class="mb-2">
        <label>Tên sản phẩm</label>
        <input name="title" class="form-control" value="<?= $p['title'] ?>" required>
    </div>

    <div class="mb-2">
        <label>Giá</label>
        <input name="price" type="number" class="form-control" value="<?= $p['price'] ?>" required>
    </div>

    <div class="mb-2">
        <label>Số lượng</label>
        <input name="qty" type="number" class="form-control" value="<?= $p['qty'] ?>" required>
    </div>

    <div class="mb-2">
        <label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $p['category_id']) ? 'selected' : '' ?>>
                    <?= $category['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-2">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"><?= $p['description'] ?></textarea>
    </div>

    <div class="mb-2">
        <label>Hình ảnh hiện tại</label><br>
        <img src="/public/images/<?= $p['images'] ?>" width="120" class="mb-2 border">
        <input type="file" name="image" class="form-control">
        <small class="text-muted">Chọn ảnh mới nếu muốn thay đổi, nếu không hãy để trống.</small>
    </div>

    <input type="hidden" name="created_at" value="<?= $p['created_at'] ?>">

    <div class="mt-3">
        <button name="update" class="btn btn-primary">Lưu thay đổi</button>
        <a href="/Admin/index.php?page=products" class="btn btn-secondary">Quay lại</a>
    </div>

</form>
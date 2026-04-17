<h3 class="mb-3">Thêm sản phẩm</h3>

<form method="POST" enctype="multipart/form-data">

    <input name="title"
           class="form-control mb-2"
           placeholder="Tên sản phẩm"
           required>

    <input name="price"
           type="number"
           class="form-control mb-2"
           placeholder="Giá"
           required>

    <input name="qty"
           type="number"
           class="form-control mb-2"
           placeholder="Số lượng"
           required>

    <select name="category_id" class="form-control mb-2" required>
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>">
                <?= $category['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <textarea name="description"
              class="form-control mb-2"
              placeholder="Mô tả"></textarea>

    <input type="file"
           name="image"
           class="form-control mb-2"
           required>

    <input type="hidden"
           name="created_at"
           value="<?= date('Y-m-d') ?>">

    <button name="create"
            class="btn btn-success">
        Save
    </button>
    
    <a href="/Admin/index.php?page=products" class="btn btn-secondary">Hủy</a>

</form>

<div class="container-fluid">
    <h3 class="mb-3">Cập nhật danh mục</h3>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   value="<?= $cat['name'] ?>" 
                   required>
        </div>

        <div>
            <button name="update" class="btn btn-primary px-4">Cập nhật</button>
            <a href="?page=categories" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
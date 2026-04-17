<div class="container-fluid">
    <h3 class="mb-3">Thêm danh mục mới</h3>

    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   placeholder="Ví dụ: Giày Bóng Rổ, Giày Chạy Bộ..." 
                   required>
        </div>

        <div>
            <button name="create" class="btn btn-success px-4">Lưu lại</button>
            <a href="?page=categories" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
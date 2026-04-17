<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Quản lý danh mục</h3>
        <a href="?page=category-create" class="btn btn-primary">Thêm danh mục mới</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="10%">ID</th>
                <th>Tên danh mục</th>
                <th width="20%">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?= $cat['id'] ?></td>
                        <td><?= $cat['name'] ?></td>
                        <td>
                            <a href="?page=category-edit&id=<?= $cat['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="?page=category-delete&id=<?= $cat['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Duy có chắc muốn xóa danh mục này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Chưa có danh mục nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
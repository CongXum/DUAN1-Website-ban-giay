<?php
$categories = $categoryModel->getAll();
?>

<div class="page-header">
  <h2><i class="fa fa-list me-2"></i>Quản lý danh mục</h2>
  <a href="?page=create-category" class="btn-add">
    <i class="fa fa-plus me-1"></i> Thêm danh mục
  </a>
</div>

<!-- Search -->
<div class="filter-bar">
  <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm danh mục..." class="form-control" style="max-width:320px;">
</div>

<div class="table-card">
  <table class="admin-table" id="catTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Ảnh</th>
        <th>Tên danh mục</th>
        <th>Mô tả</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($categories)): ?>
        <tr><td colspan="7" class="text-center text-muted py-4">Chưa có danh mục nào.</td></tr>
      <?php else: ?>
        <?php foreach ($categories as $i => $cat): ?>
          <tr data-name="<?= strtolower($cat['name']) ?>">
            <td><?= $i + 1 ?></td>
            <td>
              <?php if (!empty($cat['image'])): ?>
                <img src="../public/images/categories/<?= htmlspecialchars($cat['image']) ?>"
                     onerror="this.onerror=null; this.src='../assets/img/product/default.png'"
                     class="product-thumb" alt="">
              <?php else: ?>
                <div class="no-img"><i class="fa fa-image"></i></div>
              <?php endif; ?>
            </td>
            <td class="fw-semibold"><?= htmlspecialchars($cat['name']) ?></td>
            <td class="text-muted" style="font-size:13px;max-width:220px;">
              <?= htmlspecialchars(mb_strimwidth($cat['content'] ?? '', 0, 60, '…')) ?>
            </td>
            <td>
              <?php if ($cat['status']): ?>
                <span class="status-badge active">Hoạt động</span>
              <?php else: ?>
                <span class="status-badge inactive">Ẩn</span>
              <?php endif; ?>
            </td>
            <td class="text-muted" style="font-size:13px;"><?= $cat['created_at'] ?></td>
            <td>
              <div class="action-btns">
                <a href="?page=edit-category&id=<?= $cat['id'] ?>" class="btn-action edit" title="Sửa">
                  <i class="fa fa-pen"></i>
                </a>
                <a href="?page=delete-category&id=<?= $cat['id'] ?>"
                   class="btn-action delete"
                   title="Xóa"
                   onclick="return confirm('Xóa danh mục này? Các sản phẩm trong danh mục sẽ mất liên kết.')">
                  <i class="fa fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<style>
.page-header { display:flex; justify-content:space-between; align-items:center; padding:20px 24px 10px; }
.page-header h2 { font-size:20px; font-weight:700; color:#1e293b; margin:0; }
.btn-add { background:#1a56db; color:#fff; border:none; padding:9px 18px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; transition:.2s; }
.btn-add:hover { background:#1e429f; color:#fff; }

.filter-bar { padding:10px 24px 16px; }
.filter-bar .form-control { border-radius:8px; border:1.5px solid #e2e8f0; font-size:14px; }

.table-card { background:#fff; border-radius:14px; box-shadow:0 2px 12px rgba(0,0,0,.07); margin:0 24px 24px; overflow:hidden; }
.admin-table { width:100%; border-collapse:collapse; }
.admin-table thead tr { background:#f8fafc; }
.admin-table th { padding:13px 14px; font-size:13px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.5px; border-bottom:2px solid #e2e8f0; }
.admin-table td { padding:13px 14px; font-size:14px; color:#1e293b; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
.admin-table tbody tr:hover { background:#f8fafc; }

.product-thumb { width:54px; height:54px; object-fit:cover; border-radius:8px; border:1.5px solid #e2e8f0; }
.no-img { width:54px; height:54px; border-radius:8px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:20px; }

.status-badge { padding:4px 12px; border-radius:20px; font-size:12px; font-weight:700; }
.status-badge.active   { background:#dcfce7; color:#166534; }
.status-badge.inactive { background:#f1f5f9; color:#64748b; }

.action-btns { display:flex; gap:6px; }
.btn-action { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; font-size:13px; text-decoration:none; transition:.2s; }
.btn-action.edit   { background:#fef3c7; color:#d97706; }
.btn-action.delete { background:#fee2e2; color:#dc2626; }
.btn-action:hover  { opacity:.8; transform:scale(1.1); }
</style>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#catTable tbody tr[data-name]').forEach(row => {
        row.style.display = row.dataset.name.includes(q) ? '' : 'none';
    });
});
</script>
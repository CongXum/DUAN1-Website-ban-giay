<?php
$products   = $productModel->getAll();
$categories = $productModel->getAllCategories();

// Map category_id -> name để tra nhanh
$catMap = [];
foreach ($categories as $c) {
    $catMap[$c['id']] = $c['name'];
}
?>

<div class="page-header">
  <h2><i class="fa fa-box me-2"></i>Quản lý sản phẩm</h2>
  <a href="?page=create-product" class="btn-add">
    <i class="fa fa-plus me-1"></i> Thêm sản phẩm
  </a>
</div>

<!-- Search -->
<div class="filter-bar">
  <input type="text" id="searchInput" placeholder="🔍 Tìm kiếm sản phẩm..." class="form-control" style="max-width:320px;">
  <select id="catFilter" class="form-select" style="max-width:200px;">
    <option value="">Tất cả danh mục</option>
    <?php foreach ($categories as $c): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div class="table-card">
  <table class="admin-table" id="productTable">
    <thead>
      <tr>
        <th>#</th>
        <th>Ảnh</th>
        <th>Tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>SL</th>
        <th>Ngày tạo</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($products)): ?>
        <tr><td colspan="8" class="text-center text-muted py-4">Chưa có sản phẩm nào.</td></tr>
      <?php else: ?>
        <?php foreach ($products as $i => $item): ?>
          <tr data-cat="<?= $item['category_id'] ?>" data-name="<?= strtolower($item['title']) ?>">
            <td><?= $i + 1 ?></td>
            <td>
              <img src="../public/images/<?= htmlspecialchars($item['images']) ?>"
                   onerror="this.onerror=null; this.src='../assets/img/product/default.png'"
                   class="product-thumb" alt="">
            </td>
            <td class="fw-semibold"><?= htmlspecialchars($item['title']) ?></td>
            <td>
              <span class="badge-cat"><?= htmlspecialchars($catMap[$item['category_id']] ?? '—') ?></span>
            </td>
            <td class="price-cell"><?= number_format($item['price']) ?> đ</td>
            <td>
              <span class="qty-badge <?= $item['qty'] <= 0 ? 'out' : ($item['qty'] <= 5 ? 'low' : 'ok') ?>">
                <?= $item['qty'] ?>
              </span>
            </td>
            <td class="text-muted" style="font-size:13px;"><?= $item['created_at'] ?></td>
            <td>
              <div class="action-btns">
                <a href="?page=view-product&id=<?= $item['id'] ?>" class="btn-action view" title="Xem">
                  <i class="fa fa-eye"></i>
                </a>
                <a href="?page=update-product&id=<?= $item['id'] ?>" class="btn-action edit" title="Sửa">
                  <i class="fa fa-pen"></i>
                </a>
                <a href="?page=delete-product&id=<?= $item['id'] ?>"
                   class="btn-action delete"
                   title="Xóa"
                   onclick="return confirm('Bạn chắc muốn xóa sản phẩm này?')">
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

.filter-bar { display:flex; gap:12px; padding:10px 24px 16px; flex-wrap:wrap; }
.filter-bar .form-control, .filter-bar .form-select { border-radius:8px; border:1.5px solid #e2e8f0; font-size:14px; }

.table-card { background:#fff; border-radius:14px; box-shadow:0 2px 12px rgba(0,0,0,.07); margin:0 24px 24px; overflow:hidden; }
.admin-table { width:100%; border-collapse:collapse; }
.admin-table thead tr { background:#f8fafc; }
.admin-table th { padding:13px 14px; font-size:13px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.5px; border-bottom:2px solid #e2e8f0; }
.admin-table td { padding:13px 14px; font-size:14px; color:#1e293b; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
.admin-table tbody tr:hover { background:#f8fafc; }

.product-thumb { width:54px; height:54px; object-fit:cover; border-radius:8px; border:1.5px solid #e2e8f0; }
.badge-cat { background:#eff6ff; color:#1a56db; padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600; }
.price-cell { font-weight:700; color:#e53e3e; }
.qty-badge { padding:3px 10px; border-radius:20px; font-size:12px; font-weight:700; }
.qty-badge.ok  { background:#dcfce7; color:#166534; }
.qty-badge.low { background:#fef3c7; color:#92400e; }
.qty-badge.out { background:#fee2e2; color:#991b1b; }

.action-btns { display:flex; gap:6px; }
.btn-action { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; font-size:13px; text-decoration:none; transition:.2s; }
.btn-action.view  { background:#eff6ff; color:#1a56db; }
.btn-action.edit  { background:#fef3c7; color:#d97706; }
.btn-action.delete{ background:#fee2e2; color:#dc2626; }
.btn-action:hover { opacity:.8; transform:scale(1.1); }
</style>

<script>
const searchInput = document.getElementById('searchInput');
const catFilter   = document.getElementById('catFilter');
const rows        = document.querySelectorAll('#productTable tbody tr[data-name]');

function filterTable() {
    const q   = searchInput.value.toLowerCase();
    const cat = catFilter.value;
    rows.forEach(row => {
        const nameMatch = row.dataset.name.includes(q);
        const catMatch  = !cat || row.dataset.cat === cat;
        row.style.display = (nameMatch && catMatch) ? '' : 'none';
    });
}
searchInput.addEventListener('input', filterTable);
catFilter.addEventListener('change', filterTable);
</script>
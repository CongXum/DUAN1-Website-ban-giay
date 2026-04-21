<?php
$id   = (int)($_GET['id'] ?? 0);
$item = $productModel->getOne($id);

if (!$item) {
    echo '<div class="alert alert-danger m-4">Sản phẩm không tồn tại.</div>';
    return;
}

$cat = $productModel->getCategoryById($item['category_id']);
?>

<div class="page-header">
  <h2><i class="fa fa-eye me-2"></i>Chi tiết sản phẩm</h2>
  <div style="display:flex;gap:10px;">
    <a href="?page=update-product&id=<?= $item['id'] ?>" class="btn-edit">
      <i class="fa fa-pen me-1"></i> Chỉnh sửa
    </a>
    <a href="?page=products" class="btn-back">
      <i class="fa fa-arrow-left me-1"></i> Quay lại
    </a>
  </div>
</div>

<div class="view-card">
  <div class="view-grid">

    <!-- Ảnh sản phẩm -->
    <div class="view-img-col">
      <div class="img-wrapper">
        <img src="../public/images/<?= htmlspecialchars($item['images']) ?>"
             onerror="this.onerror=null; this.src='../assets/img/product/default.png'"
             alt="<?= htmlspecialchars($item['title']) ?>">
      </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="view-info-col">
      <h3 class="product-title"><?= htmlspecialchars($item['title']) ?></h3>

      <div class="meta-row">
        <span class="badge-cat"><i class="fa fa-list me-1"></i><?= htmlspecialchars($cat['name'] ?? '—') ?></span>
        <?php if ($item['qty'] <= 0): ?>
          <span class="stock-badge out"><i class="fa fa-times-circle me-1"></i>Hết hàng</span>
        <?php elseif ($item['qty'] <= 5): ?>
          <span class="stock-badge low"><i class="fa fa-exclamation-circle me-1"></i>Sắp hết (<?= $item['qty'] ?>)</span>
        <?php else: ?>
          <span class="stock-badge ok"><i class="fa fa-check-circle me-1"></i>Còn hàng (<?= $item['qty'] ?>)</span>
        <?php endif; ?>
      </div>

      <div class="price-display"><?= number_format($item['price']) ?> đ</div>

      <div class="info-grid">
        <div class="info-item">
          <div class="info-label">ID sản phẩm</div>
          <div class="info-value">#<?= $item['id'] ?></div>
        </div>
        <div class="info-item">
          <div class="info-label">Ngày tạo</div>
          <div class="info-value"><?= $item['created_at'] ?></div>
        </div>
        <div class="info-item">
          <div class="info-label">Số lượng tồn</div>
          <div class="info-value"><?= $item['qty'] ?></div>
        </div>
        <div class="info-item">
          <div class="info-label">Danh mục</div>
          <div class="info-value"><?= htmlspecialchars($cat['name'] ?? '—') ?></div>
        </div>
      </div>

      <div class="desc-section">
        <div class="desc-label">Mô tả sản phẩm</div>
        <p class="desc-text"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
      </div>

      <div class="action-row">
        <a href="?page=update-product&id=<?= $item['id'] ?>" class="btn-action-lg edit">
          <i class="fa fa-pen me-2"></i>Chỉnh sửa
        </a>
        <a href="?page=delete-product&id=<?= $item['id'] ?>"
           class="btn-action-lg delete"
           onclick="return confirm('Xóa sản phẩm này?')">
          <i class="fa fa-trash me-2"></i>Xóa
        </a>
      </div>
    </div>

  </div>
</div>

<style>
.page-header { display:flex; justify-content:space-between; align-items:center; padding:20px 24px 10px; }
.page-header h2 { font-size:20px; font-weight:700; color:#1e293b; margin:0; }
.btn-back { background:#f1f5f9; color:#475569; padding:9px 16px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; }
.btn-edit { background:#1a56db; color:#fff; padding:9px 16px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; }
.btn-edit:hover { background:#1e429f; color:#fff; }

.view-card { background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,.08); margin:10px 24px 24px; padding:32px; }
.view-grid { display:grid; grid-template-columns:1fr 1.5fr; gap:36px; }

.img-wrapper { background:#f8fafc; border-radius:14px; border:1.5px solid #e2e8f0; padding:20px; text-align:center; }
.img-wrapper img { max-height:340px; max-width:100%; object-fit:contain; }

.product-title { font-size:22px; font-weight:800; color:#1e293b; margin-bottom:14px; line-height:1.3; }
.meta-row { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:16px; }
.badge-cat { background:#eff6ff; color:#1a56db; padding:5px 14px; border-radius:20px; font-size:13px; font-weight:600; }
.stock-badge { padding:5px 14px; border-radius:20px; font-size:13px; font-weight:600; }
.stock-badge.ok  { background:#dcfce7; color:#166534; }
.stock-badge.low { background:#fef3c7; color:#92400e; }
.stock-badge.out { background:#fee2e2; color:#991b1b; }
.price-display { font-size:32px; font-weight:800; color:#e53e3e; margin-bottom:20px; }

.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:20px; }
.info-item { background:#f8fafc; border-radius:10px; padding:14px 16px; }
.info-label { font-size:11px; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px; }
.info-value { font-size:15px; font-weight:700; color:#1e293b; }

.desc-section { margin-bottom:24px; }
.desc-label { font-size:13px; font-weight:700; color:#374151; margin-bottom:8px; }
.desc-text { font-size:14px; color:#64748b; line-height:1.7; background:#f8fafc; border-radius:10px; padding:14px; margin:0; }

.action-row { display:flex; gap:12px; }
.btn-action-lg { display:inline-flex; align-items:center; padding:10px 24px; border-radius:9px; font-size:14px; font-weight:700; text-decoration:none; transition:.2s; }
.btn-action-lg.edit   { background:#1a56db; color:#fff; }
.btn-action-lg.edit:hover { background:#1e429f; }
.btn-action-lg.delete { background:#fee2e2; color:#dc2626; }
.btn-action-lg.delete:hover { background:#dc2626; color:#fff; }
</style>
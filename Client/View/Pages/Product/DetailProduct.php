<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$item = $product->getOne($id);

if (!$item) {
    echo '<div class="container py-5"><div class="alert alert-danger">Sản phẩm không tồn tại.</div></div>';
    return;
}

$category = $product->getCategoryById($item['category_id']);
$categories = $product->getAllCategories();
?>

<div class="container-fluid py-4">
  <div class="row">

    <!-- SIDEBAR DANH MỤC (giống ProductItems) -->
    <div class="col-md-2">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
          <i class="bi bi-grid-fill me-2"></i>Danh mục
        </div>
        <div class="list-group list-group-flush">
          <a href="/Client/index.php?page=product"
             class="list-group-item list-group-item-action">
            <i class="bi bi-house me-2"></i>Tất cả
          </a>
          <?php foreach ($categories as $cat): ?>
            <a href="index.php?page=product&cat=<?= $cat['id'] ?>"
               class="list-group-item list-group-item-action <?= $cat['id'] == $item['category_id'] ? 'active' : '' ?>">
              <i class="bi bi-tag me-2"></i><?= htmlspecialchars($cat['name']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- NỘI DUNG CHI TIẾT -->
    <div class="col-md-10">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php?page=home">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="index.php?page=product">Sản phẩm</a></li>
          <?php if ($category): ?>
            <li class="breadcrumb-item">
              <a href="index.php?page=product&cat=<?= $category['id'] ?>">
                <?= htmlspecialchars($category['name']) ?>
              </a>
            </li>
          <?php endif; ?>
          <li class="breadcrumb-item active"><?= htmlspecialchars($item['title']) ?></li>
        </ol>
      </nav>

      <!-- Chi tiết sản phẩm -->
      <div class="card border-0 shadow-sm p-4 mb-4">
        <div class="row g-4">

          <!-- Hình ảnh -->
          <div class="col-md-5 text-center">
            <img src="assets/img/product/<?= htmlspecialchars($item['images']) ?>"
                 class="img-fluid rounded"
                 style="max-height: 380px; object-fit: contain;"
                 alt="<?= htmlspecialchars($item['title']) ?>">
          </div>

          <!-- Thông tin -->
          <div class="col-md-7">
            <h3 class="fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>

            <div class="mb-3">
              <span class="badge bg-secondary">
                <i class="bi bi-grid me-1"></i>
                <?= htmlspecialchars($category['name'] ?? 'Không xác định') ?>
              </span>
              <?php if ($item['qty'] > 0): ?>
                <span class="badge bg-success ms-2">
                  <i class="bi bi-check-circle me-1"></i>Còn hàng (<?= $item['qty'] ?>)
                </span>
              <?php else: ?>
                <span class="badge bg-danger ms-2">Hết hàng</span>
              <?php endif; ?>
            </div>

            <h4 class="text-danger fw-bold mb-4" style="font-size: 28px;">
              <?= number_format($item['price']) ?> đ
            </h4>

            <div class="mb-4">
              <h6 class="fw-semibold text-muted mb-2">Mô tả sản phẩm</h6>
              <p class="text-muted lh-lg"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
            </div>

            <hr>

            <!-- Nút hành động -->
            <div class="d-flex flex-wrap gap-3 mt-3">
              <a href="index.php?page=cart&id=<?= $item['id'] ?>"
                 class="btn btn-success btn-lg px-4">
                <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ
              </a>
              <a href="index.php?page=order&id=<?= $item['id'] ?>"
                 class="btn btn-danger btn-lg px-4">
                <i class="bi bi-bag-check me-2"></i>Đặt hàng ngay
              </a>
              <a href="/Client/index.php?page=product"
                 class="btn btn-outline-secondary btn-lg px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php
$categories = $product->getAllCategories();

$category_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

if ($category_id > 0) {
    $products = $product->getByCategory($category_id);
} else {
    $products = $product->getAll();
}
?>

<div class="container-fluid py-4">
  <div class="row">

    <!-- SIDEBAR DANH MỤC -->
    <div class="col-md-2">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-semibold">
          <i class="bi bi-grid-fill me-2"></i>Danh mục
        </div>
        <div class="list-group list-group-flush">
          <a href="index.php?page=product"
             class="list-group-item list-group-item-action <?= $category_id === 0 ? 'active' : '' ?>">
            <i class="bi bi-house me-2"></i>Tất cả
          </a>
          <?php foreach ($categories as $cat): ?>
            <a href="index.php?page=product&cat=<?= $cat['id'] ?>"
               class="list-group-item list-group-item-action <?= $category_id === $cat['id'] ? 'active' : '' ?>">
              <i class="bi bi-tag me-2"></i><?= htmlspecialchars($cat['name']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- DANH SÁCH SẢN PHẨM -->
    <div class="col-md-10">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 fw-semibold">
          <?php if ($category_id > 0):
            $currentCat = $product->getCategoryById($category_id);
            echo htmlspecialchars($currentCat['name'] ?? 'Danh mục');
          else: ?>
            Tất cả sản phẩm
          <?php endif; ?>
        </h5>
        <span class="text-muted small"><?= count($products) ?> sản phẩm</span>
      </div>

      <?php if (empty($products)): ?>
        <div class="alert alert-info">Không có sản phẩm nào trong danh mục này.</div>
      <?php else: ?>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
          <?php foreach ($products as $item): ?>
            <div class="col">
              <div class="card h-100 shadow-sm border-0">
                <img src="public/images/<?= htmlspecialchars($item['images']) ?>"
                     class="card-img-top"
                     style="height: 300px; object-fit: cover;"
                     alt="<?= htmlspecialchars($item['title']) ?>">
                <div class="card-body d-flex flex-column p-3">
                  <h6 class="card-title" style="
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    height: 44px;
                    font-size: 14px;">
                    <?= htmlspecialchars($item['title']) ?>
                  </h6>
                  <p class="text-danger fw-bold mb-3" style="font-size: 15px;">
                    <?= number_format($item['price']) ?> đ
                  </p>
                  <div class="mt-auto d-flex gap-2">
                    <a href="index.php?page=detail&id=<?= $item['id'] ?>"
                       class="btn btn-primary btn-sm flex-fill">
                      <i class="bi bi-eye me-1"></i>Xem
                    </a>
                    <a href="index.php?page=cart&id=<?= $item['id'] ?>"
                       class="btn btn-success btn-sm flex-fill">
                      <i class="bi bi-cart-plus me-1"></i>Thêm
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>
<?php
$categories  = $product->getAllCategories();
$category_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
$search      = trim($_GET['search'] ?? '');

if ($category_id > 0) {
  $products = $product->getByCategory($category_id);
} else {
  $products = $product->getAll();
}

// Lọc theo search nếu có
if ($search !== '') {
  $products = array_filter($products, function ($p) use ($search) {
    return stripos($p['title'], $search) !== false;
  });
}

// ===== PHÂN TRANG =====
$perPage = 8; // số sản phẩm mỗi trang
$page = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;

$totalProducts = count($products);
$totalPages = ceil($totalProducts / $perPage);

// Giới hạn page
if ($page > $totalPages) $page = $totalPages;

// Cắt mảng sản phẩm theo trang
$start = ($page - 1) * $perPage;
$products = array_slice($products, $start, $perPage);

$currentCatName = 'Tất cả sản phẩm';
if ($category_id > 0) {
  $currentCat = $product->getCategoryById($category_id);
  $currentCatName = $currentCat['name'] ?? 'Danh mục';
}
?>


<div class="container-fluid py-4 px-4">
  <div class="row g-4">

    <!-- ===== SIDEBAR DANH MỤC ===== -->
    <div class="col-12 col-md-3 col-lg-2 cat-sidebar">
      <div class="card">
        <div class="card-header text-white fw-semibold py-3">
          <i class="bi bi-grid-fill me-2"></i>Danh mục
        </div>
        <div class="list-group list-group-flush">
          <a href="/Client/index.php?page=product"
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

    <!-- ===== NỘI DUNG CHÍNH ===== -->
    <div class="col-12 col-md-9 col-lg-10">

      <!-- Thanh tìm kiếm -->
      <form method="get" action="index.php" class="mb-4">
        <input type="hidden" name="page" value="product">
        <?php if ($category_id > 0): ?>
          <input type="hidden" name="cat" value="<?= $category_id ?>">
        <?php endif; ?>
        <div class="input-group search-bar" style="max-width: 480px;">
          <input type="text" name="search" class="form-control"
            placeholder="Tìm kiếm sản phẩm..."
            value="<?= htmlspecialchars($search) ?>">
          <button class="btn text-white" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>

      <!-- Tiêu đề & đếm -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="section-title mb-0"><?= htmlspecialchars($currentCatName) ?></h5>
        <span class="badge bg-secondary rounded-pill fs-6">
          <?= count($products) ?> sản phẩm
        </span>
      </div>

      <!-- Danh sách sản phẩm -->
      <?php if (empty($products)): ?>
        <div class="empty-state">
          <i class="bi bi-box-seam"></i>
          <p>Không tìm thấy sản phẩm nào.</p>
          <a href="index.php?page=product" class="btn btn-primary btn-sm mt-2">
            <i class="bi bi-arrow-left me-1"></i>Xem tất cả
          </a>
        </div>
      <?php else: ?>
        <div class="product-list">
          <?php foreach ($products as $item): ?>
            <div class="product-item">
              <div class="card product-card h-100">

                <!-- Ảnh -->
                <div class="img-wrap">
                  <img src="public/images/<?= htmlspecialchars($item['images']) ?>"
                    alt="<?= htmlspecialchars($item['title']) ?>"
                    onerror="this.onerror=null; this.src='assets/img/product/default.png'">
                  <?php if ($item['qty'] <= 0): ?>
                    <span class="badge bg-danger badge-stock">Hết hàng</span>
                  <?php elseif ($item['qty'] <= 5): ?>
                    <span class="badge bg-warning text-dark badge-stock">Sắp hết</span>
                  <?php endif; ?>
                </div>

                <!-- Info -->
                <div class="card-body d-flex flex-column">
                  <p class="card-title"><?= htmlspecialchars($item['title']) ?></p>
                  <p class="price"><?= number_format($item['price']) ?> đ</p>

                  <div class="mt-auto d-flex btn-group-custom">

                    <!-- Nút xem -->
                    <a href="index.php?page=detail&id=<?= $item['id'] ?>"
                      class="btn btn-detail text-white w-50">
                      <i class="bi bi-eye me-1"></i>Xem
                    </a>

                    <!-- Form giỏ hàng -->
                    <form method="post" action="index.php?page=add-cart" class="w-50">
                      <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                      <button type="submit" class="btn btn-cart w-100"
                        <?= $item['qty'] <= 0 ? 'disabled' : '' ?>>
                        <i class="bi bi-cart-plus"></i>
                      </button>
                    </form>

                  </div>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <?php if ($totalPages > 1): ?>
        <nav class="mt-4">
          <ul class="pagination justify-content-center">

            <!-- Prev -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
              <a class="page-link"
                href="?page=product&p=<?= $page - 1 ?>&cat=<?= $category_id ?>&search=<?= urlencode($search) ?>">
                «
              </a>
            </li>

            <!-- Số trang -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link"
                  href="?page=product&p=<?= $i ?>&cat=<?= $category_id ?>&search=<?= urlencode($search) ?>">
                  <?= $i ?>
                </a>
              </li>
            <?php endfor; ?>

            <!-- Next -->
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
              <a class="page-link"
                href="?page=product&p=<?= $page + 1 ?>&cat=<?= $category_id ?>&search=<?= urlencode($search) ?>">
                »
              </a>
            </li>

          </ul>
        </nav>
      <?php endif; ?>

    </div>
  </div>
</div>
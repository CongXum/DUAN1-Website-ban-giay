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
    $products = array_filter($products, function($p) use ($search) {
        return stripos($p['title'], $search) !== false;
    });
}

$currentCatName = 'Tất cả sản phẩm';
if ($category_id > 0) {
    $currentCat = $product->getCategoryById($category_id);
    $currentCatName = $currentCat['name'] ?? 'Danh mục';
}
?>

<style>
  :root {
    --brand: #1a56db;
    --brand-dark: #1e429f;
    --accent: #f05252;
    --surface: #f9fafb;
    --card-radius: 14px;
  }

  body { background: var(--surface); font-family: 'Segoe UI', sans-serif; }

  /* ===== SIDEBAR ===== */
  .cat-sidebar .card { border-radius: var(--card-radius); border: none; box-shadow: 0 2px 12px rgba(0,0,0,.07); overflow: hidden; }
  .cat-sidebar .card-header { background: linear-gradient(135deg, var(--brand), var(--brand-dark)); font-size: 14px; letter-spacing: .4px; }
  .cat-sidebar .list-group-item { font-size: 14px; border: none; border-bottom: 1px solid #f0f0f0; padding: 10px 16px; transition: all .2s; }
  .cat-sidebar .list-group-item:hover  { background: #eff6ff; color: var(--brand); padding-left: 22px; }
  .cat-sidebar .list-group-item.active { background: var(--brand); color: #fff; font-weight: 600; }

  /* ===== SEARCH BAR ===== */
  .search-bar .form-control { border-radius: 50px 0 0 50px; border: 2px solid #e5e7eb; padding: 10px 18px; font-size: 14px; }
  .search-bar .form-control:focus { border-color: var(--brand); box-shadow: none; }
  .search-bar .btn { border-radius: 0 50px 50px 0; padding: 10px 20px; background: var(--brand); border: none; }
  .search-bar .btn:hover { background: var(--brand-dark); }

  /* ===== PRODUCT CARD ===== */
  .product-card { border: none; border-radius: var(--card-radius); box-shadow: 0 2px 10px rgba(0,0,0,.07); transition: transform .25s, box-shadow .25s; overflow: hidden; }
  .product-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,.13); }
  .product-card .img-wrap { position: relative; overflow: hidden; height: 220px; background: #f1f5f9; }
  .product-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
  .product-card:hover .img-wrap img { transform: scale(1.06); }
  .product-card .badge-stock { position: absolute; top: 10px; left: 10px; font-size: 11px; padding: 4px 10px; border-radius: 20px; }
  .product-card .card-body { padding: 14px 16px 16px; }
  .product-card .card-title { font-size: 14px; font-weight: 600; color: #111827; line-height: 1.4; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
  .product-card .price { font-size: 16px; font-weight: 700; color: var(--accent); margin: 6px 0 12px; }
  .product-card .btn-detail { border-radius: 8px; font-size: 13px; font-weight: 600; background: var(--brand); border: none; padding: 7px 0; }
  .product-card .btn-detail:hover { background: var(--brand-dark); }
  .product-card .btn-cart { border-radius: 8px; font-size: 13px; font-weight: 600; border: 2px solid var(--brand); color: var(--brand); padding: 7px 0; background: transparent; }
  .product-card .btn-cart:hover { background: var(--brand); color: #fff; }

  /* ===== EMPTY STATE ===== */
  .empty-state { text-align: center; padding: 60px 20px; }
  .empty-state i { font-size: 56px; color: #d1d5db; margin-bottom: 16px; }
  .empty-state p { color: #6b7280; font-size: 15px; }

  /* ===== SECTION TITLE ===== */
  .section-title { font-size: 18px; font-weight: 700; color: #111827; position: relative; padding-left: 14px; }
  .section-title::before { content: ''; position: absolute; left: 0; top: 3px; bottom: 3px; width: 4px; background: var(--brand); border-radius: 4px; }
</style>

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
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3">
          <?php foreach ($products as $item): ?>
            <div class="col">
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

                <!-- Thông tin -->
                <div class="card-body d-flex flex-column">
                  <p class="card-title"><?= htmlspecialchars($item['title']) ?></p>
                  <p class="price"><?= number_format($item['price']) ?> đ</p>

                  <div class="mt-auto d-flex gap-2">
                    <a href="index.php?page=detail&id=<?= $item['id'] ?>"
                       class="btn btn-detail text-white flex-fill">
                      <i class="bi bi-eye me-1"></i>Xem
                    </a>
                    <form method="post" action="index.php?page=add-cart" class="flex-fill">
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

    </div>
  </div>
</div>
<?php
$currentCatName = 'Tất cả sản phẩm';

if (!empty($category_id)) {
  foreach ($categories as $cat) {
    if ($cat['id'] == $category_id) {
      $currentCatName = $cat['name'];
      break;
    }
  }
}
?>

<style>
  .product-wrap {
    background: #f4f6f9;
  }

  /* ================= SIDEBAR ================= */
  .shop-sidebar {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
  }

  .shop-sidebar-header {
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
    color: #fff;
    padding: 14px;
    font-weight: 600;
    font-size: 15px;
  }

  .shop-category a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 14px;
    text-decoration: none;
    color: #333;
    border-bottom: 1px solid #f1f1f1;
    transition: 0.2s;
    font-size: 14px;
  }

  .shop-category a:hover {
    background: #f0f6ff;
    padding-left: 18px;
  }

  .shop-category a.active {
    background: #0d6efd;
    color: #fff;
    font-weight: 600;
  }

  /* ================= SEARCH BAR ================= */
  .shop-search {
    background: #fff;
    padding: 12px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    display: flex;
    gap: 10px;
    align-items: center;
  }

  .shop-search input {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 10px 14px;
    width: 100%;
    outline: none;
    transition: 0.2s;
  }

  .shop-search input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
  }

  .shop-search button {
    border-radius: 12px;
    padding: 10px 18px;
  }

  /* ================= PRODUCT CARD ================= */
  .shop-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    transition: 0.25s;
  }

  .shop-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
  }

  .shop-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: 0.3s;
  }

  .shop-card:hover img {
    transform: scale(1.05);
  }

  .shop-title {
    font-size: 14px;
    font-weight: 600;
    height: 42px;
    overflow: hidden;
  }

  .shop-price {
    color: #dc3545;
    font-weight: 700;
    margin: 6px 0;
  }

  .shop-btn {
    border-radius: 10px;
    font-size: 13px;
  }

  /* ================= BADGE ================= */
  .shop-badge {
    background: #e9ecef;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
  }
</style>

<div class="product-wrap container-fluid py-4">

  <div class="row g-4">

    <!-- ================= SIDEBAR ================= -->
    <div class="col-md-3 col-lg-2">

      <div class="shop-sidebar">

        <div class="shop-sidebar-header">
          🗂 Danh mục sản phẩm
        </div>

        <div class="shop-category">

          <a href="index.php?page=product"
            class="<?= empty($category_id) ? 'active' : '' ?>">
            📦 Tất cả
            <span class="badge bg-light text-dark"><?= count($categories) ?></span>
          </a>

          <?php foreach ($categories as $cat): ?>
            <a href="index.php?page=product&cat=<?= $cat['id'] ?>"
              class="<?= ($category_id == $cat['id']) ? 'active' : '' ?>">
              📁 <?= htmlspecialchars($cat['name']) ?>
            </a>
          <?php endforeach; ?>

        </div>

      </div>

    </div>

    <!-- ================= MAIN ================= -->
    <div class="col-md-9 col-lg-10">

      <!-- SEARCH -->
      <form method="get" action="index.php" class="shop-search mb-3">

        <input type="hidden" name="page" value="product">

        <?php if (!empty($category_id)): ?>
          <input type="hidden" name="cat" value="<?= $category_id ?>">
        <?php endif; ?>

        <input type="text"
          name="search"
          value="<?= htmlspecialchars($search ?? '') ?>"
          placeholder="🔍 Tìm sản phẩm...">

        <button class="btn btn-primary">
          Tìm
        </button>

      </form>

      <!-- HEADER -->
      <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="fw-bold mb-0">
          <?= htmlspecialchars($currentCatName) ?>
        </h5>

        <span class="shop-badge">
          <?= count($products) ?> sản phẩm
        </span>

      </div>

      <!-- PRODUCT GRID -->
      <div class="row">

        <?php foreach ($products as $item): ?>
          <div class="col-md-3 col-6 mb-4">

            <div class="shop-card">

              <img src="public/images/<?= htmlspecialchars($item['images']) ?>"
                onerror="this.src='assets/img/product/default.png'">

              <div class="p-3">

                <div class="shop-title">
                  <?= htmlspecialchars($item['title']) ?>
                </div>

                <div class="shop-price">
                  <?= number_format($item['price']) ?> đ
                </div>

                <a href="index.php?page=product-detail&id=<?= $item['id'] ?>"
                  class="btn btn-primary btn-sm w-100 shop-btn">
                  Xem chi tiết
                </a>

              </div>

            </div>

          </div>
        <?php endforeach; ?>

      </div>

      <!-- PAGINATION -->
      <?php if ($totalPages > 1): ?>
        <div class="text-center mt-3">

          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=product&p=<?= $i ?>&cat=<?= $category_id ?>&search=<?= urlencode($search) ?>"
              class="btn btn-sm <?= ($i == $page) ? 'btn-dark' : 'btn-outline-dark' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

        </div>
      <?php endif; ?>

    </div>

  </div>
</div>
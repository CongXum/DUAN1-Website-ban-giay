<?php
$imagePath = !empty($item['images'])
  ? "public/images/" . htmlspecialchars($item['images'])
  : "assets/img/product/default.png";
?>

<style>
  /* =========================
PRODUCT DETAIL - ISOLATED UI
========================= */

  .pd-wrap {
    background: #f5f7fb;
    padding: 30px 0;
  }

  .pd-breadcrumb {
    font-size: 13px;
    margin-bottom: 15px;
    color: #6b7280;
  }

  .pd-breadcrumb a {
    text-decoration: none;
    color: #2563eb;
  }

  .pd-breadcrumb a:hover {
    text-decoration: underline;
  }

  /* MAIN CARD */
  .pd-card {
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
  }

  /* IMAGE */
  .pd-media {
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px;
  }

  .pd-media img {
    width: 100%;
    max-height: 450px;
    object-fit: contain;
    transition: .35s ease;
  }

  .pd-media img:hover {
    transform: scale(1.06);
  }

  /* INFO */
  .pd-info {
    padding: 28px;
  }

  .pd-title {
    font-size: 24px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 10px;
  }

  .pd-price {
    font-size: 30px;
    font-weight: 900;
    color: #ef4444;
    margin-bottom: 10px;
  }

  /* STOCK */
  .pd-stock {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }

  .pd-stock.ok {
    background: #dcfce7;
    color: #16a34a;
  }

  .pd-stock.no {
    background: #fee2e2;
    color: #dc2626;
  }

  /* DESC */
  .pd-desc {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.7;
    margin-top: 15px;
  }

  /* BUTTONS */
  .pd-actions {
    margin-top: 25px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .pd-btn {
    padding: 10px 14px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: .25s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .pd-btn:hover {
    transform: translateY(-2px);
  }

  /* buy */
  .pd-btn-buy {
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: #fff;
    border: none;
  }

  /* back */
  .pd-btn-back {
    border: 1px solid #e5e7eb;
    color: #374151;
    background: #fff;
  }

  /* sticky */
  .pd-sticky {
    position: sticky;
    top: 20px;
  }

  /* responsive */
  @media(max-width:768px) {
    .pd-title {
      font-size: 20px;
    }

    .pd-price {
      font-size: 24px;
    }
  }
</style>

<div class="pd-wrap container">

  <!-- breadcrumb -->
  <div class="pd-breadcrumb">
    <a href="index.php?page=home">Home</a> /
    <a href="index.php?page=product">Product</a> /
    <span><?= htmlspecialchars($item['title']) ?></span>
  </div>

  <!-- card -->
  <div class="pd-card row g-0">

    <!-- image -->
    <div class="col-md-5 pd-media">
      <img src="<?= $imagePath ?>">
    </div>

    <!-- info -->
    <div class="col-md-7 pd-sticky">
      <div class="pd-info">

        <div class="pd-title">
          <?= htmlspecialchars($item['title']) ?>
        </div>

        <div class="pd-price">
          <?= number_format($item['price']) ?> đ
        </div>

        <div>
          <?php if (($item['qty'] ?? 0) > 0): ?>
            <span class="pd-stock ok">Còn hàng</span>
          <?php else: ?>
            <span class="pd-stock no">Hết hàng</span>
          <?php endif; ?>
        </div>

        <div class="pd-desc">
          <?= nl2br(htmlspecialchars($item['description'] ?? 'Không có mô tả')) ?>
        </div>

        <div class="pd-actions">

          <a href="index.php?page=add-cart&id=<?= $item['id'] ?>"
            class="pd-btn pd-btn-buy">
            🛒 Thêm giỏ
          </a>

          <a href="index.php?page=product"
            class="pd-btn pd-btn-back">
            ← Quay lại
          </a>

        </div>

      </div>
    </div>

  </div>
  <?php if (!empty($_SESSION['flash_success'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['flash_success'] ?>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
  <?php endif; ?>
  <!-- COMMENT BOX -->
  <div class="mt-5">

    <h5 class="fw-bold mb-3">Bình luận</h5>

    <?php if (!empty($_SESSION['user']['id']) || !empty($_SESSION['user_id'])): ?>

      <form method="POST" action="index.php?page=add-comment" class="mb-4">

        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">

        <textarea name="content"
          class="form-control"
          rows="3"
          placeholder="Viết bình luận..."
          required></textarea>

        <button class="btn btn-primary mt-2">
          Gửi bình luận
        </button>

      </form>

    <?php else: ?>
      <div class="alert alert-warning">
        Bạn cần đăng nhập để bình luận
      </div>
    <?php endif; ?>

    <!-- LIST -->
    <?php if (!empty($comments)): ?>
      <?php foreach ($comments as $c): ?>

        <div class="border rounded p-3 mb-2 bg-white">

          <div class="d-flex justify-content-between">

            <strong><?= htmlspecialchars($c['user_name']) ?></strong>

            <small class="text-muted">
              <?= $c['created_at'] ?>
            </small>

          </div>

          <div class="mt-1">
            <?= htmlspecialchars($c['content']) ?>
          </div>

        </div>

      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted">Chưa có bình luận nào</p>
    <?php endif; ?>

  </div>
</div>
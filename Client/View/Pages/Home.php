<?php
$categories = $categories ?? [];
$products   = $products ?? [];
$blogs      = $blogs ?? [];
?>

<!-- SLIDER -->
<div class="slider-area">
    <div class="single-slider slider-height"
         style="background-image:url('assets/img/hero/h1_hero.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-md-6 d-none d-md-block">
                    <img src="assets/img/hero/hero_man.png" class="img-fluid">
                </div>

                <div class="col-md-5">
                    <div class="hero__caption">
                        <span>🔥 Sale 60%</span>
                        <h1>Shop Giày <br> Chính Hãng</h1>
                        <p>Giảm giá cực sốc hôm nay</p>
                        <a href="index.php?page=product" class="btn btn-dark">
                            Mua ngay
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CATEGORY -->
<section class="category-area section-padding30">
    <div class="container">
        <h2 class="text-center mb-5">Danh mục</h2>

        <div class="row">
            <?php foreach ($categories as $cat): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="index.php?page=product&cat=<?= $cat['id'] ?>">
                        <div class="card shadow-sm h-100">
                        
                            <div class="card-body text-center">
                                <h5><?= htmlspecialchars($cat['name']) ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PRODUCT -->
<section class="latest-product-area section-padding30">
    <div class="container">

        <h2 class="text-center mb-5">Sản phẩm mới</h2>

        <div class="row">
            <?php foreach ($products as $item): ?>
<div class="col-xl-3 col-lg-4 col-md-6">
    <div class="card product-card mb-4 shadow-sm h-100 d-flex flex-column">

        <!-- ẢNH -->
        <img src="public/images/<?= $item['images'] ?? 'default.png' ?>"
             onerror="this.src='public/images/default.png'"
             class="product-img">

        <!-- BODY -->
        <div class="card-body d-flex flex-column">

            <!-- TÊN -->
            <h6 class="product-title">
                <a href="index.php?page=product-detail&id=<?= $item['id'] ?>">
                    <?= htmlspecialchars($item['title']) ?>
                </a>
            </h6>

            <!-- GIÁ -->
            <p class="product-price">
                <?= number_format($item['price']) ?> đ
            </p>

            <!-- NÚT -->
            <div class="mt-auto d-flex gap-2">

    <!-- Nút xem -->
    <a href="index.php?page=product-detail&id=<?= $item['id'] ?>"
       class="btn btn-outline-dark btn-action w-50 d-flex align-items-center justify-content-center">
        Xem
    </a>

    <!-- Nút giỏ -->
    <form method="POST" action="index.php?page=add-cart" class="w-50">
        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">

        <button type="submit"
            class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
            <?= ($item['qty'] ?? 1) <= 0 ? 'disabled' : '' ?>>
            + Giỏ
        </button>
    </form>

</div>

        </div>
    </div>
</div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- BANNER -->
<div class="py-5 bg-dark text-white text-center">
    <div class="container">
        <h2>Tìm sản phẩm tốt nhất</h2>
        <p>Hàng chính hãng – Giá tốt – Giao nhanh</p>
        <a href="index.php?page=product" class="btn btn-light">
            Khám phá ngay
        </a>
    </div>
</div>

<!-- BLOG -->
<section class="blog-area section-padding30">
    <div class="container">

        <h2 class="text-center mb-5">Bài viết mới</h2>

        <div class="row">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-lg-4 col-md-6">

                    <div class="card mb-4 shadow-sm">

                        <img src="public/images/<?= $blog['thumbnail'] ?? 'default.png' ?>"
                             style="height:200px;object-fit:cover">

                        <div class="card-body">

                            <h5>
                                <a href="index.php?page=blog-detail&id=<?= $blog['id'] ?>">
                                    <?= htmlspecialchars($blog['title']) ?>
                                </a>
                            </h5>

                            <p class="text-muted">
                                <?= substr(strip_tags($blog['content']), 0, 100) ?>...
                            </p>

                            <a href="index.php?page=blog-detail&id=<?= $blog['id'] ?>">
                                Xem thêm →
                            </a>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- SERVICE -->
<div class="py-5 bg-light">
    <div class="container text-center">

        <div class="row">
            <div class="col-md-4">
                <h6>🚚 Giao hàng miễn phí</h6>
                <p>Đơn từ 500k</p>
            </div>

            <div class="col-md-4">
                <h6>🔒 Thanh toán an toàn</h6>
                <p>Nhiều phương thức</p>
            </div>

            <div class="col-md-4">
                <h6>🔄 Đổi trả dễ dàng</h6>
                <p>Trong 7 ngày</p>
            </div>
        </div>

    </div>
</div>
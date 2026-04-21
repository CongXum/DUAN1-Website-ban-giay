<main class="pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-lg border-0 text-center p-5">

                    <!-- ICON SUCCESS -->
                    <div class="mb-4">
                        <div style="
                            width: 100px;
                            height: 100px;
                            background: #28a745;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin: auto;
                        ">
                            <i class="fas fa-check text-white" style="font-size: 40px;"></i>
                        </div>
                    </div>

                    <!-- TITLE -->
                    <h2 class="text-success fw-bold mb-3">
                        Đặt hàng thành công!
                    </h2>

                    <!-- MESSAGE -->
                    <p class="text-muted mb-4">
                        Cảm ơn bạn đã mua hàng 🎉 <br>
                        Đơn hàng của bạn đã được ghi nhận và đang được xử lý.
                    </p>

                    <!-- ORDER INFO (tuỳ chọn) -->
                    <?php if (isset($_GET['order_id'])): ?>
                        <div class="alert alert-light border mb-4">
                            Mã đơn hàng của bạn: 
                            <strong>#<?= htmlspecialchars($_GET['order_id']) ?></strong>
                        </div>
                    <?php endif; ?>

                    <!-- BUTTON -->
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="index.php?page=product" class="btn btn-primary px-4">
                            Tiếp tục mua hàng
                        </a>

                        <a href="index.php?page=orders" class="btn btn-outline-secondary px-4">
                            Xem đơn hàng
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</main>
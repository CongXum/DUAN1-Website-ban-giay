<main class="pt-5 pb-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">🛒 Giỏ Hàng Của Bạn</h2>
        </div>

        <form action="index.php?page=update-cart" method="POST">

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">

                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th>Tạm tính</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $total = 0; ?>

                            <?php foreach ($cartItems as $item): ?>
                                <?php
                                $price = $item['price'] ?? 0;
                                $qty = $item['qty'];
                                $subTotal = $price * $qty;
                                $total += $subTotal;
                                ?>

                                <tr>
                                    <!-- PRODUCT -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="public/images/<?= $item['image'] ?? 'default.png' ?>"
                                                width="80"
                                                class="rounded me-3 border">

                                            <div>
                                                <h6 class="mb-1"><?= $item['product_name'] ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- PRICE -->
                                    <td class="text-danger fw-semibold">
                                        <?= number_format($price) ?> đ
                                    </td>

                                    <!-- QTY -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">

                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary minus">-</button>

                                            <input type="number"
                                                name="qty[<?= $item['id'] ?>]"
                                                value="<?= $qty ?>"
                                                min="0"
                                                class="form-control text-center mx-2 qty-input"
                                                data-id="<?= $item['id'] ?>" style="width: 70px;">

                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary plus">+</button>
                                        </div>
                                    </td>

                                    <!-- SUBTOTAL -->
                                    <td class="fw-bold">
                                        <?= number_format($subTotal) ?> đ
                                    </td>

                                    <!-- DELETE -->
                                    <td>
                                        <a href="index.php?page=delete-cart&id=<?= $item['id'] ?>"
                                            class="text-danger fs-5"
                                            onclick="return confirm('Xóa sản phẩm này?')">
                                            🗑
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- BUTTON UPDATE -->
            <div class="mt-4 d-flex justify-content-between">
                <a href="index.php?page=product" class="btn btn-outline-secondary">
                    ← Tiếp tục mua
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    🔄 Cập nhật giỏ hàng
                </button>
            </div>

        </form>

        <!-- TOTAL -->
        <div class="row mt-5 justify-content-end">
            <div class="col-lg-4">

                <div class="card shadow border-0">
                    <div class="card-body">

                        <h5 class="mb-3">🧾 Thanh toán</h5>
                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tổng tiền:</span>
                            <strong><?= number_format($total) ?> đ</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Ship:</span>
                            <strong class="text-success">Miễn phí</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fs-5">
                            <strong>Thanh toán:</strong>
                            <strong class="text-danger">
                                <?= number_format($total) ?> đ
                            </strong>
                        </div>

                        <a href="index.php?page=checkout"
                            class="btn btn-success w-100 mt-3">
                            💳 Thanh toán
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<script src="assets/js/cart.js"></script>
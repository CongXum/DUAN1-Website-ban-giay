<main class="pt-5 pb-5 bg-light">
    <div class="container">
        <h3 class="mb-4 fw-bold">🛒 Giỏ hàng của bạn</h3>

        <form action="index.php?page=update-cart" method="POST">

            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="public/images/<?= $item['images'] ?? 'default.png' ?>"
                                                 width="70"
                                                 class="rounded me-3"
                                                 style="object-fit:cover">
                                            <div>
                                                <h6 class="mb-1"><?= htmlspecialchars($item['title']) ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-danger fw-bold">
                                        <?= number_format($item['price']) ?> đ
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">

                                            <button type="button"
                                                    onclick="decrease(this)"
                                                    class="btn btn-sm btn-outline-secondary">
                                                -
                                            </button>

                                            <input type="number"
                                                   name="qty[<?= $item['id'] ?>]"
                                                   value="<?= $item['qty'] ?>"
                                                   min="1"
                                                   class="form-control text-center mx-2 qty-input"
                                                   style="width:60px">

                                            <button type="button"
                                                    onclick="increase(this)"
                                                    class="btn btn-sm btn-outline-secondary">
                                                +
                                            </button>

                                        </div>
                                    </td>

                                    <td class="fw-bold">
                                        <?= number_format($item['price'] * $item['qty']) ?> đ
                                    </td>

                                    <td>
                                        <a href="index.php?page=delete-cart&id=<?= $item['id'] ?>"
                                           class="btn btn-sm btn-danger">
                                            🗑
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-primary px-4">
                    🔄 Cập nhật giỏ hàng
                </button>

                <a href="index.php?page=product" class="btn btn-outline-dark px-4">
                    ← Mua thêm
                </a>
            </div>

        </form>

        <!-- TOTAL -->
        <div class="row justify-content-end mt-5">
            <div class="col-md-4">
                <div class="card shadow border-0 p-4">
                    <h5 class="mb-3">Tổng thanh toán</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tiền:</span>
                        <strong><?= number_format($total) ?> đ</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Phí ship:</span>
                        <strong class="text-success">Miễn phí</strong>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fs-5 fw-bold">
                        <span>Thành tiền:</span>
                        <span class="text-danger"><?= number_format($total) ?> đ</span>
                    </div>

                    <a href="index.php?page=checkout"
                       class="btn btn-danger w-100 mt-3">
                        🧾 Thanh toán ngay
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- JS tăng giảm -->
<script>
function increase(btn){
    let input = btn.parentElement.querySelector('.qty-input');
    input.value = parseInt(input.value) + 1;
}

function decrease(btn){
    let input = btn.parentElement.querySelector('.qty-input');
    if(input.value > 1){
        input.value = parseInt(input.value) - 1;
    }
}
</script>
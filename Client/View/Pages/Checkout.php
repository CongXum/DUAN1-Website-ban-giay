<?php
$user_id = $_SESSION['user']['id'] ?? 0;
$cartItems = $cartModel->getAll($user_id);

$total = 0;
?>

<main class="pt-5 pb-5">
    <div class="container">
        <h2 class="text-center mb-5">Thanh Toán</h2>

        <form method="POST" action="index.php?page=place-order" id="checkoutForm">
            <div class="row">

                <!-- FORM THÔNG TIN -->
                <div class="col-lg-7">
                    <div class="card p-4">
                        <h5>Thông tin khách hàng</h5>

                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name="name" class="form-control">
                            <small class="text-danger error" id="error-name"></small>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <small class="text-danger error" id="error-email"></small>
                        </div>

                        <div class="mb-3">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control">
                            <small class="text-danger error" id="error-phone"></small>
                        </div>

                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <textarea name="address" class="form-control"></textarea>
                            <small class="text-danger error" id="error-address"></small>
                        </div>
                        <h5 class="mt-4">Phương thức thanh toán</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                            <label class="form-check-label">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="bank">
                            <label class="form-check-label">
                                Chuyển khoản ngân hàng
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="vnpay">
                            <label class="form-check-label">
                                Thanh toán VNPay
                            </label>
                        </div>

                        <small class="text-danger error" id="error-payment"></small>
                    </div>

                </div>


                <div class="col-lg-5">
                    <div class="card p-4">
                        <h5>Đơn hàng</h5>
                        <hr>

                        <?php foreach ($cartItems as $item):
                            $subtotal = $item['qty'] * $item['price'];
                            $total += $subtotal;
                        ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong><?= htmlspecialchars($item['title']) ?></strong><br>
                                    <small>x <?= $item['qty'] ?></small>
                                </div>
                                <span><?= number_format($subtotal) ?> đ</span>
                            </div>
                        <?php endforeach; ?>

                        <hr>

                        <div class="d-flex justify-content-between fw-bold">
                            <span>Tổng:</span>
                            <span><?= number_format($total) ?> đ</span>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-4">
                            Đặt hàng
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</main>
<script src="assets/js/checkout.js"></script>
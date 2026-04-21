<?php
$id = $_GET['id'] ?? 0;

$order = $orderModel->getOne($id);
$orderItems = $orderModel->getDetailOrder($id);

$total = 0;
?>

<main class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">
            Chi Tiết Đơn Hàng #<?= $id ?>
        </h2>

        <div class="row g-4">
            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 p-4">
                    <h5 class="fw-semibold">Sản phẩm</h5>
                    <hr>

                    <?php if (empty($orderItems)): ?>
                        <p class="text-muted">Không có sản phẩm nào</p>
                    <?php endif; ?>

                    <?php foreach ($orderItems as $item):
                        $price = (int)$item['price'];
                        $qty = (int)$item['qty'];

                        $subtotal = $price * $qty;
                        $total += $subtotal;
                    ?>

                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <!-- Info -->
                            <div class="d-flex align-items-center gap-3">
                                <img src="public/images/<?= $item['images'] ?? 'default.png' ?>"
                                    width="70" height="70"
                                    style="object-fit:cover;border-radius:10px;">
                                <div>
                                    <strong><?= $item['title'] ?></strong><br>
                                    <small class="text-muted">
                                        SL: <?= $item['qty'] ?>
                                    </small>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="text-end">
                                <span class="fw-semibold text-danger">
                                    <?= number_format($subtotal) ?> đ
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- THÔNG TIN ĐƠN -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 p-4">
                    <h5 class="fw-semibold">Thông tin đơn hàng</h5>
                    <hr>

                    <p><strong>Khách hàng:</strong> <?= $order['name'] ?? '' ?></p>
                    <p><strong>Email:</strong> <?= $order['email'] ?? '' ?></p>
                    <p><strong>Điện thoại:</strong> <?= $order['phone'] ?? '' ?></p>
                    <p><strong> Địa chỉ:</strong> <?= $order['address'] ?? '' ?></p>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tiền:</span>
                        <strong class="text-danger fs-5">
                            <?= number_format($total) ?> đ
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Trạng thái:</span>

                        <?php
                        $status = $order['status'] ?? 'pending';

                        $statusText = [
                            'pending' => 'Chờ xử lý',
                            'processing' => 'Đang xử lý',
                            'shipping' => 'Đang giao',
                            'completed' => 'Hoàn thành',
                            'cancelled' => 'Đã hủy'
                        ];

                        $statusClass = [
                            'pending' => 'warning',
                            'processing' => 'info',
                            'shipping' => 'primary',
                            'completed' => 'success',
                            'cancelled' => 'danger'
                        ];
                        ?>

                        <span class="badge bg-<?= $statusClass[$status] ?? 'secondary' ?>">
                            <?= $statusText[$status] ?? $status ?>
                        </span>
                    </div>

                    <a href="index.php?page=product" class="btn btn-dark w-100">
                        ← Tiếp tục mua hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
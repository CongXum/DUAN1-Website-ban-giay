<?php
$user_id = $_SESSION['user']['id'] ?? 0;

if ($user_id == 0) {
    echo "<div class='text-center mt-5'>Vui lòng đăng nhập</div>";
    exit;
}

$orders = $orderModel->getByUser($user_id);
?>

<main class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Đơn Hàng Của Tôi</h2>

        <?php if (empty($orders)): ?>
            <div class="text-center">
                <p class="text-muted">Bạn chưa có đơn hàng nào</p>
                <a href="index.php?page=product" class="btn btn-dark">
                    Đi mua ngay
                </a>
            </div>
        <?php else: ?>

            <div class="table-responsive">
                <table class="table align-middle bg-white shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mã đơn</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index => $order):

                            $status = $order['status'] ?? 'pending';

                            $statusText = [
                                'pending' => 'Chờ xử lý',
                                'paid' => 'Đã thanh toán',
                                'processing' => 'Đang xử lý',
                                'shipping' => 'Đang giao',
                                'completed' => 'Hoàn thành',
                                'cancelled' => 'Đã hủy'
                            ];

                            $statusClass = [
                                'pending' => 'warning',
                                'paid' => 'success',
                                'processing' => 'info',
                                'shipping' => 'primary',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                        ?>
                            <tr>
                                <td><?= $index + 1 ?></td>

                                <td>
                                    <strong>#<?= $order['id'] ?></strong>
                                </td>

                                <td class="text-danger fw-semibold">
                                    <?= isset($order['total'])
                                        ? number_format($order['total']) . ' đ'
                                        : '0 đ' ?>
                                </td>

                                <td>
                                    <span class="badge bg-<?= $statusClass[$status] ?? 'secondary' ?>">
                                        <?= $statusText[$status] ?? $status ?>
                                    </span>
                                </td>

                                <td>
                                    <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                                </td>

                                <td>
                                    <a href="index.php?page=order-detail&id=<?= $order['id'] ?>"
                                        class="btn btn-sm btn-dark">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </div>
</main>
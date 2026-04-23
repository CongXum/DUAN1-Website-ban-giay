<?php
// Client/View/Pages/Orders.php

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit();
}

$userId = $_SESSION['user']['id'];

// Lấy danh sách đơn hàng của user
$orders = $orderModel->getOrdersByUserId($userId);
?>  

<main class="pt-5 pb-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Đơn Hàng Của Tôi</h2>

        <div class="mb-3">
            <a href="index.php?page=profile" class="btn btn-secondary">← Quay lại Profile</a>
        </div>

        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                <td><?php echo number_format($order['total']); ?> đ</td>
                                <td>
                                    <?php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($order['status']) {
                                        case 'pending':
                                            $statusClass = 'bg-warning';
                                            $statusText = 'Chờ xác nhận';
                                            break;
                                        case 'processing':
                                            $statusClass = 'bg-info';
                                            $statusText = 'Đang xử lý';
                                            break;
                                        case 'shipping':
                                            $statusClass = 'bg-primary';
                                            $statusText = 'Đang giao';
                                            break;
                                       case 'completed':
                                            $statusClass = 'bg-primary';
                                            $statusText = 'Hoàn thành';
                                            break;
                                        case 'paid':
                                            $statusClass = 'bg-success';
                                            $statusText = 'Đã thanh toán';
                                            break;
                                        case 'cancelled':
                                            $statusClass = 'bg-danger';
                                            $statusText = 'Đã hủy';
                                            break;
                                        default:
                                            $statusClass = 'bg-secondary';
                                            $statusText = 'Không xác định';
                                    }
                                    ?>
                                    <span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                </td>
                                <td><a href="index.php?page=order-detail&id=<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">Xem</a></td>
                                <td>
                                    <?php if ($order['status'] === 'pending'): ?>
                                        <a href="index.php?page=cancel-order&id=<?php echo $order['id']; ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Bạn có chắc muốn hủy đơn này không?')">
                                            Hủy
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">---</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center">
                <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
                <a href="index.php?page=home" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        <?php endif; ?>
    </div>
</main>
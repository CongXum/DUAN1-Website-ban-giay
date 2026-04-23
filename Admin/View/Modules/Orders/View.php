<?php
$id = $_GET['id'] ?? 0;
$total = 0;
?>

<div class="container-fluid">

    <div class="OrderDetail-card">

        <!-- HEADER -->
        <div class="OrderDetail-header">
            <h4>Chi tiết đơn hàng #ORD<?= $id ?></h4>

            <a href="?page=orders" class="OrderDetail-btn-back">
                ← Quay lại
            </a>
        </div>

        <!-- CUSTOMER INFO -->
        <div class="OrderDetail-section">
            <h5>Thông tin khách hàng</h5>

            <div class="OrderDetail-grid">
                <div>
                    <label>Họ tên</label>
                    <p><?= $order['name'] ?? '' ?></p>
                </div>

                <div>
                    <label>SĐT</label>
                    <p><?= $order['phone'] ?? '' ?></p>
                </div>

                <div>
                    <label>Email</label>
                    <p><?= $order['email'] ?? '' ?></p>
                </div>

                <div>
                    <label>Ngày đặt</label>
                    <p>
                        <?= isset($order['created_at'])
                            ? date('d/m/Y', strtotime($order['created_at']))
                            : '' ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- ADDRESS -->
        <div class="OrderDetail-section">
            <h5>Địa chỉ giao hàng</h5>
            <p><?= $order['address'] ?? '' ?></p>
        </div>

        <!-- PRODUCT TABLE -->
        <div class="OrderDetail-section">
            <h5>Sản phẩm trong đơn</h5>

            <table class="OrderDetail-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tạm tính</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($orderItems as $item):
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?= $item['title'] ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= number_format($item['price']) ?>đ</td>
                            <td><?= number_format($subtotal) ?>đ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- TOTAL -->
        <div class="OrderDetail-total">
            Tổng tiền:
            <span><?= number_format($total) ?>đ</span>
        </div>

        <!-- STATUS -->
        <?php
        $status = $order['status'] ?? 'pending';

        $statusText = [
            'pending' => 'Chờ xử lý',
            'paid' => 'Đã thanh toán',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];
        ?>

        <div class="OrderDetail-section">
            <h5>Trạng thái</h5>
            <p><?= $statusText[$status] ?? $status ?></p>
        </div>

        <!-- NOTE -->
        <div class="OrderDetail-section">
            <h5>Ghi chú khách hàng</h5>
            <p><?= $order['note'] ?? 'Không có ghi chú' ?></p>
        </div>

    </div>

</div>

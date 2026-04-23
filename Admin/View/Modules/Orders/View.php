<?php if (!$order || !$details): ?>
<div class="alert alert-danger">Đơn hàng không tồn tại!</div>
<?php return; endif; ?>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Đơn hàng #<?= $order['id'] ?></h4>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Khách hàng:</strong> <?= htmlspecialchars($order['name'] ?? $order['user_name'] ?? 'N/A') ?><br>
                <strong>Email:</strong> <?= htmlspecialchars($order['email'] ?? $order['user_email'] ?? 'N/A') ?><br>
                <strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?><br>
                <strong>Trạng thái:</strong> 
                <span class="badge bg-<?= $order['status'] == 'completed' ? 'success' : ($order['status'] == 'cancelled' ? 'danger' : 'warning') ?>">
                    <?= ucfirst($order['status'] ?? 'pending') ?>
                </span>
            </div>
            <div class="col-md-6">
                <strong>Tổng tiền:</strong> <h3><?= number_format($order['total_amount'] ?? 0) ?> VNĐ</h3>
            </div>
        </div>
        
        <h5>Sản phẩm trong đơn hàng:</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($details)): ?>
                    <tr><td colspan="4" class="text-center">Chưa có sản phẩm</td></tr>
                    <?php else: ?>
                        <?php foreach ($details as $item): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                                <small>IMG: <?= htmlspecialchars($item['images']) ?></small>
                            </td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price']) ?> VNĐ</td>
                            <td><?= number_format($item['quantity'] * $item['price']) ?> VNĐ</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-3 text-end">
            <a href="?page=orders" class="btn btn-secondary">← Quay lại</a>
        </div>
    </div>
</div>

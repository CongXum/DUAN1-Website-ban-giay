<?php if (empty($orders)): ?>
<div class="alert alert-info">
    <i class="fa fa-info-circle"></i> Chưa có đơn hàng nào.
</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['name'] ?? $order['user_name'] ?? 'N/A') ?></td>
                <td><?= number_format($order['total_amount'] ?? 0) ?> VNĐ</td>
                <td>
                    <span class="badge <?= $order['status'] == 'completed' ? 'bg-success' : 'bg-warning' ?>">
                        <?= ucfirst($order['status'] ?? 'pending') ?>
                    </span>
                </td>
                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                <td>
                    <a href="?page=order-view&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i> Chi tiết
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

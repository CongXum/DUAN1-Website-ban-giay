<div class="container-fluid">

    <div class="Order-card-box">

        <div class="Order-header">

            <h4><strong>Danh sách đơn hàng</strong></h4>

        </div>


        <!-- TOOLBAR -->

        <div class="Order-toolbar">

            <form method="GET" class="Order-filter-form">
                <input type="hidden" name="page" value="orders">

                <input type="text" name="keyword"
                    placeholder="Tìm mã đơn hàng..."
                    value="<?= $_GET['keyword'] ?? '' ?>">

                <select name="status">
                    <option value="">-- Trạng thái --</option>

                    <?php
                    $statuses = [
                        'pending' => 'Chờ xác nhận',
                        'paid' => 'Đã thanh toán',
                        'processing' => 'Đang xử lý',
                        'shipping' => 'Đang giao',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã huỷ'
                    ];

                    foreach ($statuses as $key => $label):
                    ?>
                        <option value="<?= $key ?>"
                            <?= ($_GET['status'] ?? '') == $key ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button>Lọc</button>
            </form>

        </div>



        <!-- TABLE -->

        <table class="Order-table">

            <thead>

                <tr>

                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>


            <tbody>
                <?php foreach ($orders as $order): ?>

                    <?php
                    $statusText = [
                        'pending' => 'Chờ xác nhận',
                        'paid' => 'Đã thanh toán',
                        'processing' => 'Đang xử lý',
                        'shipping' => 'Đang giao',
                        'completed' => 'Hoàn thành',
                        'cancelled' => 'Đã huỷ'
                    ];
                    ?>

                    <tr>
                        <td>#ORD<?= $order['id'] ?></td>
                        <td><?= $order['name'] ?></td>
                        <td><?= $order['phone'] ?></td>
                        <td><?= $order['email'] ?></td>
                        <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>

                        <td><?= number_format($order['total']) ?>đ</td>

                        <td>
                            <div class="status-dropdown">

                                <!-- BADGE -->
                                <span class="Order-status Order-status-<?= $order['status'] ?>"
                                    onclick="toggleStatus(this)">
                                    <?= $statusText[$order['status']] ?? $order['status'] ?>
                                </span>

                                <!-- MENU -->
                                <div class="status-menu">
                                    <a href="?page=update-status&id=<?= $order['id'] ?>&status=processing">Đang xử lý</a>
                                    <a href="?page=update-status&id=<?= $order['id'] ?>&status=paid">Đã thanh toán</a>
                                    <a href="?page=update-status&id=<?= $order['id'] ?>&status=shipping">Đang giao</a>
                                    <a href="?page=update-status&id=<?= $order['id'] ?>&status=completed">Hoàn thành</a>
                                    <a href="?page=update-status&id=<?= $order['id'] ?>&status=cancelled">Huỷ</a>
                                </div>

                            </div>
                        </td>

                        <td class="text-center align-middle">
                            <a href="?page=order-detail&id=<?= $order['id'] ?>"
                                class="btn btn-sm btn-info d-inline-flex align-items-center justify-content-center">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>



        <!-- PAGINATION -->

        <div class="mt-3 text-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=orders&p=<?= $i ?>&keyword=<?= $keyword ?>&status=<?= $status ?>"
                    class="btn btn-sm <?= $i == $page ? 'btn-dark' : 'btn-outline-dark' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>


    </div>

</div>
<script>
    function toggleStatus(el) {
        const parent = el.closest('.status-dropdown');

        // đóng tất cả
        document.querySelectorAll('.status-dropdown')
            .forEach(item => item.classList.remove('active'));

        // mở cái đang click
        parent.classList.toggle('active');
    }

    // click ngoài → đóng
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.status-dropdown')) {
            document.querySelectorAll('.status-dropdown')
                .forEach(item => item.classList.remove('active'));
        }
    });
</script>

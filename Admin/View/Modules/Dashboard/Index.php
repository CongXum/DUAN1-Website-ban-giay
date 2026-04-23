<div class="container-fluid">

    <div class="dashboard-wrapper">

        <div class="dashboard-cards">

            <div class="dashboard-card">
                <div class="dashboard-icon bg-primary">
                    <i class="fa fa-users"></i>
                </div>
                <div>
                    <h3><?= $totalUsers ?></h3>
                    <p>Người dùng</p>
                </div>
            </div>


            <div class="dashboard-card">
                <div class="dashboard-icon bg-success">
                    <i class="fa fa-box"></i>
                </div>
                <div>
                    <h3><?= $totalProducts ?></h3>
                    <p>Sản phẩm</p>
                </div>
            </div>


            <div class="dashboard-card">
                <div class="dashboard-icon bg-warning">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div>
                    <h3><?= $totalOrders ?></h3>
                    <p>Đơn hàng</p>
                </div>
            </div>


            <div class="dashboard-card">
                <div class="dashboard-icon bg-danger">
                    <i class="fa fa-money-bill"></i>
                </div>
                <div>
                    <h3><?= number_format($revenueToday) ?>đ</h3>
                    <p>Doanh thu hôm nay</p>
                </div>
            </div>

        </div>


        <div class="dashboard-main-grid">

            <div class="dashboard-card-box">

                <h5>Đơn gần nhất</h5>

                <table class="dashboard-table">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Khách</th>
                            <th>Tổng</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($latestOrders as $order): ?>

                            <tr>

                                <td>#<?= $order['id'] ?></td>

                                <td><?= $order['name'] ?></td>

                                <td><?= number_format($order['total']) ?>đ</td>

                                <td>

                                    <span class="dashboard-badge <?= $order['status'] ?>">

                                        <?= $order['status'] ?>

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>

                </table>

            </div>


            <div class="dashboard-card-box">

                <h5>Quick Stats</h5>

                <ul class="dashboard-stats">

                    <li>
                        <span>Đơn hôm nay</span>
                        <strong><?= $ordersToday ?></strong>
                    </li>

                    <li>
                        <span>User mới</span>
                        <strong><?= $newUsersToday ?></strong>
                    </li>

                    <li>
                        <span>Out of stock</span>
                        <strong><?= $outOfStock ?></strong>
                    </li>

                </ul>

            </div>

        </div>


        <div class="dashboard-card-box">

            <h5>Revenue 7 days</h5>

            <div class="dashboard-chart">

                <canvas id="chartRevenue"></canvas>

            </div>

        </div>

    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const data = <?= json_encode($chartData) ?>;

    const labels = data.map(item => item.day);

    const values = data.map(item => item.revenue);


    new Chart(document.getElementById("chartRevenue"), {

        type: "line",

        data: {

            labels: labels,

            datasets: [{

                label: "Revenue",

                data: values,

                tension: .4

            }]

        }

    });
</script>
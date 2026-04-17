<div class="container-fluid">

    <div class="Dashboard-wrapper">


        <!-- KPI CARDS -->

        <div class="Dashboard-cards">


            <div class="Dashboard-card">

                <div class="Dashboard-card-icon bg-primary">

                    <i class="fa fa-users"></i>

                </div>

                <div>

                    <h3>120</h3>

                    <p>Người dùng</p>

                </div>

            </div>



            <div class="Dashboard-card">

                <div class="Dashboard-card-icon bg-success">

                    <i class="fa fa-box"></i>

                </div>

                <div>

                    <h3>85</h3>

                    <p>Sản phẩm</p>

                </div>

            </div>



            <div class="Dashboard-card">

                <div class="Dashboard-card-icon bg-warning">

                    <i class="fa fa-shopping-cart"></i>

                </div>

                <div>

                    <h3>46</h3>

                    <p>Đơn hàng</p>

                </div>

            </div>



            <div class="Dashboard-card">

                <div class="Dashboard-card-icon bg-danger">

                    <i class="fa fa-newspaper"></i>

                </div>

                <div>

                    <h3>12</h3>

                    <p>Bài viết</p>

                </div>

            </div>


        </div>



        <!-- MAIN CONTENT -->

        <div class="Dashboard-main-grid">


            <!-- RECENT ORDERS -->

            <div class="Dashboard-card-box">

                <h5>Đơn hàng gần đây</h5>

                <table class="Dashboard-table">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php for ($i = 1; $i <= 5; $i++): ?>

                            <tr>

                                <td>#ORD<?= $i ?></td>

                                <td>Nguyễn Văn <?= $i ?></td>

                                <td>1.500.000đ</td>

                                <td>

                                    <span class="Dashboard-badge success">

                                        Hoàn thành

                                    </span>

                                </td>

                            </tr>

                        <?php endfor; ?>

                    </tbody>

                </table>

            </div>



            <!-- QUICK STATS -->

            <div class="Dashboard-card-box">

                <h5>Thống kê nhanh</h5>

                <ul class="Dashboard-stats">

                    <li>

                        <span>Đơn hôm nay</span>

                        <strong>8</strong>

                    </li>

                    <li>

                        <span>Doanh thu hôm nay</span>

                        <strong>6.800.000đ</strong>

                    </li>

                    <li>

                        <span>User mới</span>

                        <strong>3</strong>

                    </li>

                    <li>

                        <span>Sản phẩm hết hàng</span>

                        <strong>5</strong>

                    </li>

                </ul>

            </div>


        </div>


        <!-- CHART PLACEHOLDER -->

        <div class="Dashboard-card-box">

            <h5>Biểu đồ doanh thu</h5>

            <div class="Dashboard-chart-placeholder">

                Biểu đồ sẽ hiển thị tại đây

            </div>

        </div>


    </div>

</div>
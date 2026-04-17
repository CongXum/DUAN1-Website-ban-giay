<div class="container-fluid">

    <div class="OrderDetail-card">

        <div class="OrderDetail-header">

            <h4>Chi tiết đơn hàng #ORD001</h4>

            <a href="?page=orders"
                class="OrderDetail-btn-back">

                ← Quay lại

            </a>

        </div>


        <!-- CUSTOMER INFO -->

        <div class="OrderDetail-section">

            <h5>Thông tin khách hàng</h5>

            <div class="OrderDetail-grid">

                <div>

                    <label>Họ tên</label>

                    <p>Nguyễn Văn A</p>

                </div>

                <div>

                    <label>SĐT</label>

                    <p>0988888888</p>

                </div>

                <div>

                    <label>Email</label>

                    <p>abc@gmail.com</p>

                </div>

                <div>

                    <label>Ngày đặt</label>

                    <p>15/04/2026</p>

                </div>

            </div>

        </div>



        <!-- ADDRESS -->

        <div class="OrderDetail-section">

            <h5>Địa chỉ giao hàng</h5>

            <p>123 Nguyễn Trãi, Cần Thơ</p>

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

                    <?php for ($i = 1; $i <= 3; $i++): ?>

                        <tr>

                            <td>Giày thể thao Nike <?= $i ?></td>

                            <td>2</td>

                            <td>500.000đ</td>

                            <td>1.000.000đ</td>

                        </tr>

                    <?php endfor; ?>

                </tbody>

            </table>

        </div>



        <!-- TOTAL -->

        <div class="OrderDetail-total">

            Tổng tiền:

            <span>1.500.000đ</span>

        </div>



        <!-- NOTE -->

        <div class="OrderDetail-section">

            <h5>Ghi chú khách hàng</h5>

            <p>Giao giờ hành chính</p>

        </div>



    </div>

</div>
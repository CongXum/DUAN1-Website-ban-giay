<?php 
// Client/View/Pages/Orders.php
?>

<main class="pt-5 pb-5">
    <div class="container">
        <div class="section-tittle text-center mb-50">
            <h2>Đơn Hàng Của Tôi</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Đặt</th>
                        <th>Sản Phẩm</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#DH12345</td>
                        <td>18/04/2026</td>
                        <td>Giày Thể Thao Nam x 2</td>
                        <td>1,780,000 đ</td>
                        <td><span class="badge bg-success">Đã giao</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Xem</a></td>
                    </tr>
                    <tr>
                        <td>#DH12344</td>
                        <td>15/04/2026</td>
                        <td>Giày Sneaker Nữ</td>
                        <td>950,000 đ</td>
                        <td><span class="badge bg-warning">Đang giao</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Xem</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>
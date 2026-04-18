<?php 
// Client/View/Pages/Cart.php
?>

<main class="pt-5 pb-5">
    <div class="container">
        <div class="section-tittle text-center mb-50">
            <h2>Giỏ Hàng</h2>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sản phẩm mẫu 1 -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/assets/img/categori/product1.png" width="90" class="me-3" alt="">
                                <div>
                                    <h6>Minimalistic shop for multipurpose use</h6>
                                </div>
                            </div>
                        </td>
                        <td>890,000 đ</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-secondary">-</button>
                                <input type="text" value="1" class="form-control text-center mx-2" style="width: 60px;">
                                <button class="btn btn-sm btn-outline-secondary">+</button>
                            </div>
                        </td>
                        <td><strong>890,000 đ</strong></td>
                        <td>
                            <button class="btn btn-sm text-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <!-- Sản phẩm mẫu 2 -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/assets/img/categori/product2.png" width="90" class="me-3" alt="">
                                <div>
                                    <h6>Green Dress with details</h6>
                                </div>
                            </div>
                        </td>
                        <td>1,290,000 đ</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-secondary">-</button>
                                <input type="text" value="2" class="form-control text-center mx-2" style="width: 60px;">
                                <button class="btn btn-sm btn-outline-secondary">+</button>
                            </div>
                        </td>
                        <td><strong>2,580,000 đ</strong></td>
                        <td>
                            <button class="btn btn-sm text-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Nút Update Cart và Coupon -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <button class="btn btn-primary px-5">Update Cart</button>
            </div>
            <div class="col-lg-6 text-end">
                <button class="btn btn-primary px-5">Close Coupon</button>
            </div>
        </div>

        <!-- Tổng tiền + Thanh toán -->
        <div class="row mt-5 justify-content-end">
            <div class="col-lg-5">
                <div class="card p-4">
                    <h5>Tổng cộng</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng tiền hàng:</span>
                        <strong>3,470,000 đ</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Phí vận chuyển:</span>
                        <strong>Miễn phí</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fs-5">
                        <strong>Tổng thanh toán:</strong>
                        <strong>3,470,000 đ</strong>
                    </div>
                    <a href="index.php?page=checkout" class="btn hero-btn w-100 mt-4">
                        Thanh Toán
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
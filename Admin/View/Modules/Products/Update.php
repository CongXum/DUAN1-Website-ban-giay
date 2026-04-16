<?php

$id = $_GET['id'] ?? 0;

$product = [

    'name' => "Nike Air Max",
    'price' => 1500000,
    'category' => "Giày sneaker",
    'status' => 1

];

?>

<div class="container-fluid">

    <div class="card-box">

        <h4 class="mb-4">
            Cập nhật sản phẩm
        </h4>

        <form method="POST"
            enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Tên sản phẩm</label>

                    <input type="text"
                        class="form-control"
                        value="<?= $product['name'] ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Giá</label>

                    <input type="number"
                        class="form-control"
                        value="<?= $product['price'] ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label>Danh mục</label>

                    <select class="form-select">

                        <option selected>
                            <?= $product['category'] ?>
                        </option>

                        <option>Giày chạy bộ</option>
                        <option>Giày sneaker</option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Trạng thái</label>

                    <select class="form-select">

                        <option value="1"
                            <?= $product['status'] == 1 ? 'selected' : '' ?>>
                            Hiển thị
                        </option>

                        <option value="0"
                            <?= $product['status'] == 0 ? 'selected' : '' ?>>
                            Ẩn
                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label>Ảnh sản phẩm</label>

                    <input type="file"
                        class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label>Mô tả</label>

                    <textarea class="form-control"
                        rows="4"></textarea>

                </div>

            </div>

            <button class="btn btn-warning">

                Cập nhật sản phẩm

            </button>

            <a href="?page=products"
                class="btn btn-light">

                Quay lại

            </a>

        </form>

    </div>

</div>
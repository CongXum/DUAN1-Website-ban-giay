<?php

$id = $_GET['id'] ?? 0;

?>

<div class="container-fluid">

    <div class="card-box">

        <h4>Chi tiết sản phẩm</h4>

        <hr>

        <img src="https://via.placeholder.com/200"
            class="mb-3"
            style="border-radius:12px">

        <p><b>ID:</b> <?= $id ?></p>

        <p><b>Tên:</b> Nike Air Force 1</p>

        <p><b>Giá:</b> 2.200.000đ</p>

        <p><b>Danh mục:</b> Sneaker</p>

        <p><b>Mô tả:</b>

            Giày sneaker cao cấp phong cách trẻ trung

        </p>

        <a href="?page=products"
            class="btn btn-light">

            Quay lại

        </a>

    </div>

</div>
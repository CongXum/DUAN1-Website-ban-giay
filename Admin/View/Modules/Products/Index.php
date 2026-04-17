<?php $base = "/Admin/Index.php"; ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Quản lý sản phẩm</h3>

        <div class="Products-header">

            <h4>Danh sách sản phẩm</h4>

            <a href="?page=create-product"
                class="Products-btn-add">

                + Thêm sản phẩm

            </a>

        </div>

        <div class="Products-toolbar">

            <form method="GET" class="Products-filter-form">

                <input type="hidden" name="page" value="products">


                <select name="category" class="Products-select">

                    <option value="">-- Danh mục --</option>

                    <option value="sport"
                        <?= ($_GET['category'] ?? '') == 'sport' ? 'selected' : '' ?>>
                        Thể thao
                    </option>

                    <option value="fashion"
                        <?= ($_GET['category'] ?? '') == 'fashion' ? 'selected' : '' ?>>
                        Thời trang
                    </option>

                    <option value="running"
                        <?= ($_GET['category'] ?? '') == 'running' ? 'selected' : '' ?>>
                        Chạy bộ
                    </option>

                </select>


                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm tên sản phẩm..."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    class="Products-search-input">


                <button class="Products-btn-filter">

                    <i class="fa fa-search"></i>
                    Lọc

                </button>

            </form>

        </div>


        <table class="Products-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>

                </tr>

            </thead>

            <tbody>

                <?php for ($i = 1; $i <= 5; $i++): ?>

                    <tr>

                        <td><?= $i ?></td>

                        <td>

                            <img
                                src="https://via.placeholder.com/60"
                                class="Products-image">

                        </td>

                        <td>Giày Nike <?= $i ?></td>

                        <td class="Products-price">

                            1.500.000đ

                        </td>

                        <td class="Products-category">

                            Thể thao

                        </td>

                        <td>

                            <span class="Products-status Products-status-active">

                                Hoạt động

                            </span>

                        </td>

                        <td>

                            <div class="Products-actions">

                                <a href="?page=view-product&id=<?= $i ?>"
                                    class="Products-btn-view">

                                    <i class="fa fa-eye"></i>

                                </a>

                                <a href="?page=update-product&id=<?= $i ?>"
                                    class="Products-btn-edit">

                                    <i class="fa fa-pen"></i>

                                </a>

                                <button class="Products-btn-delete">

                                    <i class="fa fa-trash"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                <?php endfor; ?>

            </tbody>

        </table>

        <div class="Products-pagination">


            <a href="?page=products&p=1"
                class="Products-page-btn">

                «

            </a>

            <?php

            $keyword = $_GET['keyword'] ?? '';

            $category = $_GET['category'] ?? '';

            $page = $_GET['p'] ?? 1;

            $limit = 5;

            $offset = ($page - 1) * $limit;

            ?>


            <?php for ($i = 1; $i <= 5; $i++): ?>

                <a
                    href="?page=products
                    &p=<?= $i ?>
                    &category=<?= $_GET['category'] ?? '' ?>
                    &keyword=<?= $_GET['keyword'] ?? '' ?>"
                    class="Products-page-btn
                    <?= ($_GET['p'] ?? 1) == $i ? 'active' : '' ?>">

                    <?= $i ?>

                </a>

            <?php endfor; ?>


            <a href="?page=products&p=5"
                class="Products-page-btn">

                »

            </a>


        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($products as $item): ?>

                            <tr>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= $item['id'] ?>
                                    </span>
                                </td>

                                <td class="fw-bold">
                                    <?= $item['title'] ?>
                                </td>

                                <td>
                                    <img src="/public/images/<?= $item['images'] ?>"
                                         width="60" height="60"
                                         style="object-fit:cover;"
                                         class="rounded border">
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= $item['qty'] ?>
                                    </span>
                                </td>

                                <td class="text-danger fw-bold">
                                    <?= number_format($item['price']) ?> đ
                                </td>

                                <td>

                                    <!-- VIEW -->
                                    <a href="<?= $base ?>?page=product-view&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <!-- EDIT -->
                                    <a href="<?= $base ?>?page=product-edit&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <a href="<?= $base ?>?page=product-delete&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Bạn có chắc muốn xoá?')">
                                        Delete
                                    </a>

                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>

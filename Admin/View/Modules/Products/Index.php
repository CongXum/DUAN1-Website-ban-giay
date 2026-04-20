<?php $base = "/Admin/Index.php"; ?>

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

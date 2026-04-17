<?php $base = "/Admin/Index.php"; ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Quản lý sản phẩm</h3>

        <!-- THÊM -->
        <a href="<?= $base ?>?page=product-create"
           class="btn btn-primary">
            + Thêm
        </a>

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

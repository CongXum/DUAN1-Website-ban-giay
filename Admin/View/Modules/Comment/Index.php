<div class="Comment-card-box">

    <div class="Comment-header">
        <h4>Quản lý bình luận</h4>
    </div>

    <div class="Comment-toolbar">

        <form method="GET">

            <input type="hidden" name="page" value="comments">

            <input
                type="text"
                name="keyword"
                value="<?= $_GET['keyword'] ?? '' ?>"
                placeholder="Tìm tên người dùng">

            <select name="status">

                <option value="">--Trạng thái--</option>

                <option value="pending">Chờ duyệt</option>

                <option value="approved">Đã duyệt</option>

                <option value="rejected">Từ chối</option>

            </select>

            <button>Lọc</button>

        </form>

    </div>


    <table class="Comment-table">

        <thead>
            <tr>
                <th>STT</th>
                <th>Người bình luận</th>
                <th>Sản phẩm</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>

            <?php $i = ($page - 1) * $limit + 1; ?>

            <?php foreach ($comments as $c): ?>

                <tr>

                    <td><?= $i++ ?></td>

                    <td><?= $c['user_name'] ?? 'User đã xoá' ?></td>

                    <td><?= $c['product_title'] ?? 'Sản phẩm đã xoá' ?></td>

                    <td><?= htmlspecialchars($c['content']) ?></td>

                    <td>

                        <?php if ($c['status'] == 'approved'): ?>

                            <span class="badge bg-success">Đã duyệt</span>

                        <?php elseif ($c['status'] == 'pending'): ?>

                            <span class="badge bg-warning">Chờ duyệt</span>

                        <?php else: ?>

                            <span class="badge bg-danger">Từ chối</span>

                        <?php endif ?>

                    </td>

                    <td>

                        <a href="?page=approve-comment&id=<?= $c['id'] ?>"
                            class="btn btn-success btn-sm">

                            <i class="bi bi-check-circle"></i>

                        </a>

                        <a href="?page=reject-comment&id=<?= $c['id'] ?>"
                            class="btn btn-warning btn-sm">

                            <i class="bi bi-x-circle"></i>

                        </a>

                        <a href="?page=delete-comment&id=<?= $c['id'] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn chắc chắn muốn xoá?')">

                            <i class="bi bi-trash"></i>

                        </a>

                    </td>

                </tr>

            <?php endforeach ?>

        </tbody>

    </table>


    <div class="Comment-pagination">

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>

            <a class="<?= $p == $page ? 'active' : '' ?>"
                href="?page=comments&p=<?= $p ?>&keyword=<?= $keyword ?>&status=<?= $status ?>"

                <?= $p ?>

                </a>

            <?php endfor ?>

    </div>

</div>
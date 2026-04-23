<?php $blogs = $blogs ?? []; ?>

<div class="Blog-wrapper">

    <div class="Blog-hero">
        <h1>Bài viết & Tin tức</h1>
        <p>Cập nhật xu hướng, kiến thức và tin mới nhất</p>
    </div>

    <!-- FILTER -->
    <form class="Blog-filter" method="GET" action="index.php">

        <input type="hidden" name="page" value="blogs">

        <input type="text" name="keyword"
            value="<?= $_GET['keyword'] ?? '' ?>"
            placeholder="Tìm bài viết...">

        <select name="category_id">
            <option value="">-- Danh mục --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= (($_GET['category_id'] ?? '') == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Lọc</button>

    </form>

    <!-- LIST -->
    <div class="Blog-grid">

        <?php foreach ($blogs as $b): ?>

            <div class="Blog-card">

                <div class="Blog-img">
                    <img src="/public/Admin/Img/blogs/<?= $b['thumbnail'] ?? 'default.png' ?>"
                        onerror="this.src='/public/Admin/Img/blogs/default.png'">
                </div>

                <div class="Blog-body">

                    <h3 class="Blog-title">
                        <a href="index.php?page=blog-detail&id=<?= $b['id'] ?>">
                            <?= htmlspecialchars($b['title']) ?>
                        </a>
                    </h3>

                    <p class="Blog-desc">
                        <?= substr(strip_tags($b['content']), 0, 120) ?>...
                    </p>

                    <div class="Blog-meta">
                        <span>👁 <?= $b['views'] ?></span>
                        <span>📂 <?= $b['category_name'] ?? 'No category' ?></span>
                    </div>

                    <a class="Blog-btn"
                        href="index.php?page=blog-detail&id=<?= $b['id'] ?>">
                        Xem chi tiết
                    </a>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>
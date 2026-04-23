<?php
$blog = $blog ?? null;

if (!$blog) {
    echo "<div class='container py-5'><h3>Không tìm thấy bài viết</h3></div>";
    return;
}
?>

<div class="Blog-detail-wrapper container py-5">

    <!-- TITLE -->
    <h1 class="Blog-detail-title">
        <?= htmlspecialchars($blog['title']) ?>
    </h1>

    <!-- META -->
    <div class="Blog-detail-meta mb-3">
        <span>👁 <?= (int)$blog['views'] ?> lượt xem</span> |
        <span>📂 <?= htmlspecialchars($blog['category_name'] ?? 'Không danh mục') ?></span>
    </div>

    <!-- IMAGE -->
    <div class="Blog-detail-image mb-4">
        <img src="/public/Admin/Img/blogs/<?= $blog['thumbnail'] ?? 'default.png' ?>"
            onerror="this.src='/public/Admin/Img/blogs/default.png'"
            style="width:100%;max-height:400px;object-fit:cover;border-radius:10px;">
    </div>

    <!-- CONTENT -->
    <div class="Blog-detail-content">
        <?= $blog['content'] ?>
    </div>

    <!-- BACK -->
    <div class="mt-4">
        <a href="index.php?page=blogs" class="btn btn-dark">
            ← Quay lại tin tức
        </a>
    </div>

</div>
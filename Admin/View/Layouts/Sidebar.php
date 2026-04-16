<?php
$currentPage = $_GET['page'] ?? 'dashboard';
?>

<div class="sidebar">

    <div class="sidebar-top">

        <a href="?page=dashboard"
            class="<?= $currentPage == 'dashboard' ? 'active' : '' ?>">
            <i class="fa fa-home"></i>
            Thống kê
        </a>

        <a href="?page=users"
            class="<?= $currentPage == 'users' ? 'active' : '' ?>">
            <i class="fa fa-users"></i>
            Quản lý người dùng
        </a>

        <a href="?page=categories"
            class="<?= $currentPage == 'categories' ? 'active' : '' ?>">
            <i class="fa fa-list"></i>
            Quản lý danh mục
        </a>

        <a href="?page=products"
            class="<?= $currentPage == 'products' ? 'active' : '' ?>">
            <i class="fa fa-box"></i>
            Quản lý sản phẩm
        </a>

        <a href="?page=orders"
            class="<?= $currentPage == 'orders' ? 'active' : '' ?>">
            <i class="fa fa-shopping-cart"></i>
            Quản lý đơn hàng
        </a>

        <a href="?page=blog"
            class="<?= $currentPage == 'blog' ? 'active' : '' ?>">
            <i class="fa fa-newspaper"></i>
            Quản lý bài viết
        </a>

        <a href="?page=comments"
            class="<?= $currentPage == 'comments' ? 'active' : '' ?>">
            <i class="fa fa-comments"></i>
            Quản lý bình luận
        </a>

    </div>


    <div class="sidebar-bottom">

        <a href="?page=settings"
            class="<?= $currentPage == 'settings' ? 'active' : '' ?>">
            <i class="fa fa-gear"></i>
            Cài đặt
        </a>

    </div>

</div>
<?php
// Client/View/Layouts/Header.php
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Duan1 - Giày Thể Thao</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <link rel="stylesheet" href="/assets/css/slicknav.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/nice-select.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                    <div class="container-fluid">
                        <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left d-flex">

                                    <ul class="contact-now">
                                        <li>Hotline : +84 123 456 789</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-bottom header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                    <h5>Fashion Shoes</h5>
                                </div>
                            </div>
                            <!-- Main-menu -->
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">Trang chủ</a></li>
                                            <li><a href="index.php?page=contact">Liên hệ</a></li>
                                            <li><a href="index.php?page=product">Sản Phẩm</a></li>
                                            <li><a href="index.php?page=orders">Đơn hàng</a></li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Right side -->
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right">
                                            <input type="text" placeholder="Search products">
                                            <div class="search-icon">
                                                <i class="fas fa-search special-tag"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-card">
                                            <a href="index.php?page=cart"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                    <li class="d-none d-lg-block">
                                        <?php if (!empty($_SESSION['user'])): ?>
                                            <div class="header-btn-logged d-flex align-items-center">
                                                <span class="mr-2">
                                                    Chào,
                                                    <strong><?= htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></strong>
                                                </span>
                                                <a href="index.php?page=logout" class="logout-icon" title="Đăng xuất">
                                                    <i class="fas fa-sign-out-alt text-danger"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <div class="d-flex align-items-center">
                                                <a href="index.php?page=login" class="btn header-btn custom-btn">Sign In</a>
                                                <a href="index.php?page=register" class="btn header-btn custom-btn ml-2" style="background: #fb246a;">Register</a>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
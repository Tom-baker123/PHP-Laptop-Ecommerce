<?php
// Khởi động session
session_start();
$authentication = false;

if (isset($_SESSION['email'])) { $authentication = true; }

// ----------------Lấy DB---------------------- 
require 'config.php'; // Kết nối cơ sở dữ liệu

// Lấy toàn bộ danh mục sản phẩm:
$stmt = $pdo->query("SELECT * FROM DANHMUCSANPHAM");
$danhMuc = $stmt->fetchAll();

// Lấy toàn bộ sản phẩm:
$stmt = $pdo->query("SELECT * FROM SANPHAM");
$sanPham = $stmt->fetchAll();

// Lấy tên file hiện tại
$current_page = basename($_SERVER['SCRIPT_NAME']);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ECOMMERCE-LAPTOP</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- CSS tự sửa thêm -->
    <link rel="stylesheet" href="css/!_Edited.css">
</head>

<!-- Có code PHP Trong đây -->

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <!-- <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span> -->
                    <img src="img/1_LOGO.png" width="45px">
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products"
                            style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                        <div class="input-group-append">
                            <button href="#" type="submit" class="input-group-text bg-transparent text-primary"
                                style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0" style="color: #6C757D;"><img class="Hot_Line_Icon" src="img/2_Hot-Line.png" alt="">HOT
                    LINE</p>
                <h5 class="m-0"> <a style="color: #6C757D;" href="tel:19005031">1900.5031</a></h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>DANH MỤC</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <a href="shop.php"
                            class="nav-item nav-link">TẤT CẢ</a>
                        <?php foreach ($danhMuc as $dm): ?>
                            <a href="shop.php?maDM=<?= $dm['maDM'] ?>"
                                class="nav-item nav-link"><?= $dm['tenDM'] ?></a>
                        <?php endforeach; ?>

                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <img class="rounded" src="img/1_LOGO.png" width="45px">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <!-- <div style="margin-left: 140px"></div> -->
                            <div style="margin-left: 90px"></div>

                            <a href="index.php" class="font-weight-bold text-uppercase nav-item nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
                            <a href="shop.php" class="font-weight-bold text-uppercase nav-item nav-link <?= ($current_page == 'shop.php') ? 'active' : '' ?>">Shop</a>
                            <!-- <a href="detail.php" class="font-weight-bold text-uppercase nav-item nav-link">Shop Detail</a> -->
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i
                                        class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded border-0 m-0">
                                    <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                                </div>
                            </div> -->
                            <a href="cart.php" class="font-weight-bold text-uppercase nav-item nav-link <?= ($current_page == 'cart.php') ? 'active' : '' ?>">Shopping Cart</a>
                            <a href="checkout.php" class="font-weight-bold text-uppercase nav-item nav-link <?= ($current_page == 'cart.php') ? 'active' : '' ?>">Checkout</a>
                            <a href="contact.php" class="font-weight-bold text-uppercase nav-item nav-link <?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="cart.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <div class="btn-group ml-3">
                                <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <img class="rounded" src="img/cat-1.jpg" style="width: 45px; height: 45px; " alt="">
                                </button>
                                <!-- khu vực có sự thay đổi về xác thực -->
                                <?php if ($authentication == true) { ?>
                                    <?php if (isset($_SESSION['maVT']) && $_SESSION['maVT'] == 2) { ?>
                                        <div class="dropdown-menu dropdown-menu-right rounded">
                                            <a href="../ADMIN_PAGE/index.php" class="dropdown-item">ADMIN PAGE</a>
                                            <a href="./profile.php" class="dropdown-item">Profile</a>
                                            <a href="./logout.php" class="dropdown-item">Đăng Xuất</a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="dropdown-menu dropdown-menu-right rounded">
                                            <a href="./profile.php" class="dropdown-item">Profile</a>
                                            <a href="./logout.php" class="dropdown-item">Đăng Xuất</a>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="dropdown-menu dropdown-menu-right rounded">
                                        <a href="login.php" class="dropdown-item">Đăng Nhập</a>
                                        <a href="register.php" class="dropdown-item">Đăng Ký</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
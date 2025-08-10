<?php
require './Component/header.php'; // lẤY HEADER + NAVBAR
require_once './Controller/indexController.php'
?>
<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-3">
            <div class="product-offer mb-30 rounded" style="height: 200px;">
                <img class="img-fluid" src="img/Laptop/Laptop_Van_Phong.png" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Giảm Giá 90%</h6>
                    <h3 class="text-white mb-3">Ưu Đãi Đặc Biệt</h3>
                    <a href="" class="btn btn-primary rounded">Mua Ngay</a>
                </div>
            </div>
            <div class="product-offer mb-30 rounded" style="height: 200px;">
                <img class="img-fluid" src="img/Laptop/Laptop_Gaming.png" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Giảm Giá 90%</h6>
                    <h3 class="text-white mb-3">Ưu Đãi Đặc Biệt</h3>
                    <a href="" class="btn btn-primary rounded">Mua Ngay</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner rounded">
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/Carousel/Christmas_Laptop_Shopping_1.png"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="Text_Shadow display-4 text-white mb-3 animate__animated animate__fadeInDown font-weight-bold">
                                    ĐẠI GIÁ HẠ GIÁ LAPTOP
                                </h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn font-weight-bold">ƯU ĐÃI CÙNG TIỆC LAPTOP</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp rounded"
                                    href="#">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/Carousel/Christmas_Laptop_Shopping_2.png"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="Text_Shadow display-4 text-white mb-3 animate__animated animate__fadeInDown font-weight-bold">
                                    ĐẠI GIÁ HẠ GIÁ LAPTOP
                                </h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn font-weight-bold">GIÁNG SINH CÙNG TIỆC LAPTOP</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="#">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="img/Carousel/Christmas_Laptop_Shopping_3.png"
                            style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="Text_Shadow display-4 text-white mb-3 animate__animated animate__fadeInDown font-weight-bold">
                                    ĐẠI GIÁ HẠ GIÁ LAPTOP
                                </h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn font-weight-bold">TRÀN NGẬP NHỮNG MÓN QUÀ HẤP DẪN</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="#">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4 rounded shadow" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">SẢN PHẨM CHẤT LƯỢNG</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4 rounded shadow" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">MIỄN PHÍ VẬN CHUYỂN</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4 rounded shadow" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">HOÀN TRẢ 15 NGÀY</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center bg-light mb-4 rounded shadow" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">HỖ TRỢ 24/7 Liên Tiếp</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
            class="bg-secondary pr-3">DANH MỤC</span></h2>
    <div class="row px-xl-5 pb-3">
        <?php foreach ($danhMuc as $dm): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="">
                    <div class="cat-item d-flex align-items-center mb-4 rounded">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="product/pro01_ASUS.png" alt="" style="border-radius: 20px 0 0 20px;">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6><?= $dm['tenDM'] ?></h6>
                            <small class="text-body">100 Products</small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Categories End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">SẢN PHẨM TIÊU BIỂU</span></h2>
    <div class="row px-xl-5">
    <?php $randSP = getRandomProduct($pdo);
        foreach($randSP as $sp) { ?>

        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="<?= htmlspecialchars($sp['duongDan']) ?>" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href=""><?= htmlspecialchars($sp['tenSP']) ?></a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5><?= htmlspecialchars($sp['gia']) ?></h5>
                        <h6 class="text-muted ml-2"><del>UNKNOW</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!-- Products End -->


<!-- Offer Start -->
<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        <div class="col-md-12">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="/img/Laptop/Laptop_Gaming.png" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Save 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Mua Ngay</a>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">SẢN PHẨM GẦN ĐÂY</span></h2>
    <div class="row px-xl-5">
        <?php $randSP = getRandomProduct($pdo);
        foreach($randSP as $sp) { ?>

        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="<?= htmlspecialchars($sp['duongDan']) ?>" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href=""><?= htmlspecialchars($sp['tenSP']) ?></a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5><?= htmlspecialchars($sp['gia']) ?></h5>
                        <h6 class="text-muted ml-2"><del>UNKNOW</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<!-- <div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="img/vendor-1.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-2.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-3.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-4.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-5.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-6.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-7.jpg" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Vendor End -->

<?php require './Component/footer.php'; // + LẤY FOOTER 
?>
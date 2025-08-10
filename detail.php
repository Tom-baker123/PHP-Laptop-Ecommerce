<?php
require_once './Component/header.php';

// ----------------Lấy DB---------------------- 
require 'config.php';

// ----------------Lấy CONTROLLER-------------- 
require_once './Controller/detailsController.php';

// ----------------Lấy Ma SP URL---------------
$maSP = isset($_GET['maSP']) ? (int)($_GET['maSP']) : '';

// ----------------Lấy Đường Dẫn --------------
// Truy vấn để lấy đường dẫn hình ảnh theo maSP
$sql = "SELECT duongDan FROM HINHANH WHERE maSP = :maSP";
$stmt = $pdo->prepare($sql);
// Truyền tham số vào SQL
$stmt->bindParam(':maSP', $maSP, PDO::PARAM_STR);
$stmt->execute();

$hinhanhList = $stmt->fetchAll();

// ----------------Lấy Tên SP -----------------
// Truy vấn để lấy Tên SP
$sql = "SELECT * FROM SANPHAM WHERE maSP = :maSP";
$stmt = $pdo->prepare($sql);
$stmt->execute([':maSP' => $maSP]);

$sanPham = $stmt->fetch(); // Trả về kết quả hoặc false nếu không có dữ liệu

// ----------------Lấy Thông số Cấu Hình ------
// Truy vấn để lấy Tên SP
$sql = " SELECT sp.maSP, sp.tenSP, ch.tenCH, spch.giaTri 
         FROM SANPHAMCAUHINH spch JOIN CAUHINH ch 
         ON spch.maCH = ch.maCH JOIN SANPHAM sp 
         ON spch.maSP = sp.maSP WHERE sp.maSP = :maSP";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':maSP', $maSP, PDO::PARAM_STR);
$stmt->execute();
// PDO::FETCH_ASSOC chỉ định rằng kết quả sẽ được trả về dưới dạng một mảng liên kết (associative array), trong đó:
// Các tên cột trong bảng sẽ trở thành các key trong mảng.
// Các giá trị trong hàng tương ứng với các giá trị trong mảng.
$cauHinh = $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về kết quả hoặc false nếu không có dữ liệu

?>
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30 rounded">
                <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light rounded">
                    <?php if ($maSP != '') {
                        $first = true; // Biến đánh dấu phần tử đầu tiên
                        foreach ($hinhanhList as $hinhanh) {
                            // Kiểm tra nếu là phần tử đầu tiên thì thêm lớp "active"
                            $activeClass = $first ? 'active' : '';
                            if ($first) $first = false; // Sau khi đã xử lý phần tử đầu tiên, đặt lại $first thành false
                    ?>
                            <div class="carousel-item rounded <?= $activeClass ?>">
                                <img class="w-100 h-100" src="<?= $hinhanh['duongDan'] ?>" alt="Image">
                            </div>
                        <?php }
                    } else { ?>
                        <div class="carousel-item rounded active">
                            <img class="w-100 h-100" src="./img/1_LOGO.png" alt="Image">
                        </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>

        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30 rounded">
                <?php
                // Kiểm tra xem có dữ liệu trả về không
                if ($sanPham) {
                    echo "<h3>" . $sanPham['tenSP'] . "</h3>";
                } else {
                    echo "<h3> Không tìm thấy sản phẩm</h3>";
                }
                ?>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    <?php
                    // Kiểm tra xem có dữ liệu trả về không
                    if ($sanPham) {
                        echo number_format($sanPham['gia'], 0, ',', '.') . 'VND';
                    } else {
                        echo "0đ";
                    }
                    ?>

                </h3>
                <p class="mb-4">
                    <?php
                    // Kiểm tra xem có dữ liệu trả về không
                    if ($sanPham) {
                        echo $sanPham['moTa'];
                    } else {
                        echo "0đ";
                    }
                    ?>
                </p>
                <!-- <div class="d-flex mb-3">
                    <strong class="text-dark mr-3">Sizes:</strong>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <div class="d-flex mb-4">
                    <strong class="text-dark mr-3">Colors:</strong>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-5" name="color">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div> -->
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30 rounded">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">

                        <h4 class="mb-3">Cấu Hình Sản Phẩm</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="table-active">LOẠI THÔNG SỐ</th>
                                    <th class="table-active">THÔNG TIN CHI TIẾT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cauHinh as $row) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['tenCH']);?></td>
                                    <td><?= htmlspecialchars($row['giaTri'])?></td>
                                </tr>
                                <?php } ?> 
                            </tbody>
                        </table>
                        <h4 class="mb-3">Mô Tả Sản Phẩm</h4>
                        <p> <?php
                            // Kiểm tra xem có dữ liệu trả về không
                            if ($sanPham) {
                                echo $sanPham['moTa'];
                            } else {
                                echo "Bạn Không có mô tả gì ở đây hết!";
                            }
                            ?> </p>
                        <p></p>

                        <?php if ($maSP != '') {
                            foreach ($hinhanhList as $hinhanh) { ?>
                                <img class="w-100 h-100" src="<?= $hinhanh['duongDan'] ?>" alt="Image">
                            <?php }
                        } else { ?>
                            <img class="w-100 h-100" src="./img/1_LOGO.png" alt="Image">
                        <?php } ?>



                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 review for "Product Name"</h4>
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Your Name *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">SẢN PHẨM TƯƠNG TỰ</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <?php $randSP = getRandomProductDE($pdo);
                foreach($randSP as $sp) { ?>
                    <div class="product-item bg-light">
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
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<?php require './Component/footer.php'; // + LẤY FOOTER 
?>
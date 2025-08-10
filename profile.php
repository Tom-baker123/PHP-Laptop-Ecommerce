<!-- Header -->
<?php require './Component/header.php'; ?>


<div class="col-lg-8" style="margin-inline: auto;">

    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
    <div class="bg-light p-30 mb-5 shadow rounded">
        <div class="border-bottom pb-2">
            <div class="d-flex mb-3" style="position: relative;">
                <img src="./img/Banner-Profile/Banner_1.png"
                    style="width: 100%; height: 150px; background-size: contain, cover;" alt="">

            </div>
            <div style="position: absolute; bottom: 0; left: 0;">
                <img class="rounded-circle" src="/img/cat-1.jpg" alt=""
                    style="width: 100px; display: none;
                    border-color: rgba(233, 236, 239, .4) !important;
                    border-width: 20px;">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6>Email</h6>
                <h6><?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?> </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6>Họ</h6>
                <h6><?= isset($_SESSION['ho']) ? $_SESSION['ho'] : '' ?> </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6>Tên</h6>
                <h6><?= isset($_SESSION['ten']) ? $_SESSION['ten'] : '' ?> </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6>SDT</h6>
                <h6><?= isset($_SESSION['SDT']) ? $_SESSION['SDT'] : '' ?> </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6>Giới Tính</h6>
                <h6>
                    <?php
                    if (isset($_SESSION['gioiTinh'])) {
                        if ($_SESSION['gioiTinh'] == 0) {
                            echo "Nữ";
                        } elseif ($_SESSION['gioiTinh'] == 1) {
                            echo "Nam";
                        } else {
                            echo "Giá trị không hợp lệ.";
                        }
                    } else {
                        echo '';
                    }
                    ?>
                </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">

                <h6>Ngày Sinh</h6>
                <h6><?= isset($_SESSION['ngaySinh']) ? $_SESSION['ngaySinh'] : '' ?> </h6>
            </div>
            <div class="d-flex justify-content-between mb-3">

                <h6>Địa Chỉ</h6>
                <h6><?= isset($_SESSION['diaChi']) ? $_SESSION['diaChi'] : '' ?> </h6>

            </div>
            
        </div>

    </div>
</div>

<!-- Footer -->
<?php require './Component/footer.php'; ?>
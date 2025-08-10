<?php
require_once '../config.php';
require_once './component/header.php';
require_once './component/slidebar.php';

// Lấy ra Con troller cho tất cả sẳn phẩm
require_once './ControllerSanPham.php';
// Lấy ra tên cột cho bảng mình cần lấy 
$tenTable = 'SANPHAM';
$colSP = getTenCot($tenTable);

// ------------- Lấy ra toàn bộ sản phẩm ------------- 
$sanPhamDatas = getAllSP($tenTable, 'HINHANH', 'maSP');

// ------------- Lấy ra toàn bộ sản phẩm ------------- 

?>


<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Phone ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">DANH MỤC SẢN PHẨM</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="add-fees-collection.html" class="btn btn-primary"><i class="fas fa-plus"></i> THÊM SẢN PHẨM</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <?php
                                        // Lặp qua mảng tên cột và tạo thẻ <th>
                                        // foreach ($colSP as $item) {
                                        //     echo "<th>" . htmlspecialchars($item) . "</th>";
                                        // }
                                        ?>
                                        <th class="text-start">Mã Sản Phẩm</th>
                                        <th class="text-start">Tên Sản Phẩm</th>
                                        <th class="text-start">Số Lượng</th>
                                        <th class="text-start">Giá</th>
                                        <th class="text-start">Hãng</th>
                                        <th class="text-end">TÁC VỤ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- echo "<th>" . htmlspecialchars($item) . "</th>"; -->
                                    <?php foreach ($sanPhamDatas as $sp): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($sp['maSP']) ?></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="<?= htmlspecialchars($sp['duongDan']) ?>" alt="User Image"></a>
                                                    <a><?= htmlspecialchars($sp['tenSP']) ?></a>
                                                </h2>
                                            </td>
                                            <td><?= htmlspecialchars($sp['soLuong']) ?></td>
                                            <td><?= htmlspecialchars(number_format($sp['gia'], 0, ',', '.')) ?> VND</td>
                                            <td><?= getMotDM('DANHMUCSANPHAM', $sp['maDM']) ?></td>
                                            <td class="text-end">
                                                <a href="add-fees-collection.html" class="btn btn-sm bg-danger-light"><img src="/img/icon/deleteIcon.png" style="width: 15px; height: 15px; margin-right: 0;"> </a>
                                                <a href="add-fees-collection.html" class="btn btn-sm bg-danger-light"><img src="/img/icon/updateIcon.png" style="width: 15px; height: 15px; margin-right: 0;"> </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <p>Copyright © 2022 Dreamguys.</p>
    </footer>

</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/datatables/datatables.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>
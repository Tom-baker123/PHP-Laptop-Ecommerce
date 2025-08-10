<?php 
ob_start(); // Bắt đầu buffer
require_once '../config.php';
require_once './component/header.php'; 
require_once './component/slidebar.php'; 

// Lấy danh sách danh mục sản phẩm
try {
    $stmt = $pdo->query("SELECT maDM, tenDM FROM DANHMUCSANPHAM");
    $dmsp = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
}

// --------------- Xoa DM ---------------------
// Xóa Danh Mục Sản Phẩm
if (isset($_GET['deletemaDM'])) {
    $maDMDelete = isset($_GET['deletemaDM']) ? (int)$_GET['deletemaDM'] : null;

    try {
        // Lấy ra email có trong KHACHHANG Table 
        $stmt = $pdo->prepare("DELETE FROM DANHMUCSANPHAM WHERE maDM = :maDM");
        $stmt->bindParam(':maDM', $maDMDelete, PDO::PARAM_INT);
        $stmt->execute();
        
        header("location: ./View_Danh_Muc.php");
        exit;
    } catch (PDOException $e) {
        die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
    }
}
ob_end_flush(); // Gửi output sau khi xử lý
?>
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">DANH MỤC SẢN PHẨM</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">DANH MỤC SẢN PHẨM</li>
                    </ul>
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
                                    <a href="Add_Danh-Muc.php" class="btn btn-primary"><i class="fas fa-plus"></i> THÊM DANH MỤC</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã Danh Mục</th>
                                        <th>Tên Danh Mục</th>
                                        <th class="text-end">Tác Vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dmsp as $dm): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($dm['maDM']) ?></td>
                                            <td><?= htmlspecialchars($dm['tenDM']) ?></td>

                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="View_Danh_Muc.php?deletemaDM=<?= htmlspecialchars($dm['maDM']) ?>"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                        </svg>
                                                    </a>
                                                    <a href="Update_Danh-Muc.php?updateDM=<?= htmlspecialchars($dm['maDM']) ?>" class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>

                                                    </a>
                                                </div>
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
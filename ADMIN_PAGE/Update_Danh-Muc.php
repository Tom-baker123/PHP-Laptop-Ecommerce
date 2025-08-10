<?php
// ob_start(); // Bắt đầu buffer
require_once '../config.php';
require_once './component/header.php';
require_once './component/slidebar.php';

try {
    $stmt = $pdo->query("SELECT maDM, tenDM FROM DANHMUCSANPHAM");
    $dmsp = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Lỗi khi lấy dữ liệu: " . $e->getMessage());
}

$updateDM = isset($_REQUEST['updateDM']) ? (int)$_REQUEST['updateDM'] : '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ form
    $tenDM = $_POST['tenDM'];

    // Câu lệnh SQL UPDATE
    $sql = "UPDATE DANHMUCSANPHAM SET tenDM = :tenDM WHERE maDM = :maDM";

    // Chuẩn bị câu lệnh
    $stmt = $pdo->prepare($sql);

    // Sử dụng bindParam để ràng buộc các tham số
    $stmt->bindParam(':maDM', $updateDM, PDO::PARAM_INT);
    $stmt->bindParam(':tenDM', $tenDM, PDO::PARAM_STR);

    // Thực thi câu lệnh:
    $stmt->execute();

    ?>
        <script>
            window.location = 'View_Danh_Muc.php';
        </script>
    <?php
}



// ob_end_flush(); // Gửi output sau khi xử lý
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-12">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">CẬP NHẬT DANH MỤC</h3>
                        </div>
                    </div>
                </div>

                <?php
                // Truy vấn để lấy tất cả Danh mục & lấy ra tên, mã để gán lại input
                $stmt = $pdo->prepare("SELECT * FROM DANHMUCSANPHAM WHERE maDM = :maDM");
                $stmt->bindParam(':maDM', $updateDM, PDO::PARAM_INT);
                $stmt->execute();
                print_r($_REQUEST);
                
                // Kiểm tra nếu có dữ liệu trả về
                if ($stmt->rowCount() > 0) {
                    // Lấy tất cả dữ liệu thành mảng
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                ?>

                    <form action="Update_Danh-Muc.php?updateDM=<?php echo $updateDM ?>" method="post">
                        <div class="card">
                            <div class="card-body">
                                <div class="bank-inner-details">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Mã Danh Mục<span class="text-danger">*</span></label>
                                                <input name="maDM" readonly type="text" class="form-control" value="<?= htmlspecialchars($product['maDM']) ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Tên Danh Mục<span class="text-danger">*</span></label>
                                                <input name="tenDM" type="text" class="form-control" value="<?= htmlspecialchars($product['tenDM']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" blog-categories-btn pt-0 ">
                                <div class="bank-details-btn ">
                                    <button type="submit" class="btn bank-cancel-btn me-2">SỬA</button>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php

                } else {
                    echo '<p class="empty">Không có sản phẩm!</p>';
                } ?>
            </div>
        </div>
    </div>
</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/js/feather.min.js"></script>
<script src="assets/js/ckeditor.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>
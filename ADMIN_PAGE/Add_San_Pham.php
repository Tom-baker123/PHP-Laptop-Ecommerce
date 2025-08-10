<?php
require_once '../config.php';
require_once './component/header.php';
require_once './component/slidebar.php';
require_once './ControllerSanPham.php';

$tenSP  = isset($_POST['tenSP']) ? $_POST['tenSP'] : '';
$moTa   = isset($_POST['moTa']) ? $_POST['moTa'] : '';
$soLuong = isset($_POST['soLuong']) ? $_POST['soLuong'] : '';
$gia    = isset($_POST['gia']) ? $_POST['gia'] : '';
$maDM   = isset($_POST['maDM']) ? $_POST['maDM'] : '';

// Lấy các lỗi từ hàm kiểm tra và chèn dữ liệu
$errors = getInputPostAndInsert($tenSP, $moTa, $soLuong, $gia, $maDM);

?>


<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">THÊM SẢN PHẨM</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="expenses.html">Admin</a></li>
                        <li class="breadcrumb-item active">THÊM SẢN PHẨM</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Thêm Sản Phẩm</span></h5>
                                </div>

                                <div class="col-md-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Tên Sản Phẩm <span class="login-danger">*</span></label>
                                        <input name="tenSP" type="text" class="form-control" value="<?= htmlspecialchars($tenSP) ?>">
                                        <span class="text-danger"><?= isset($errors['tenSP_error']) ? htmlspecialchars($errors['tenSP_error']) : '' ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Mô tả <span class="login-danger">*</span></label>
                                        <textarea name="moTa" class="form-control" rows="3"><?= htmlspecialchars($moTa) ?></textarea>
                                        <span class="text-danger"><?= isset($errors['moTa_error']) ? htmlspecialchars($errors['moTa_error']) : '' ?></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Số Lượng <span class="login-danger">*</span></label>
                                        <input name="soLuong" type="number" class="form-control" value="<?= htmlspecialchars($soLuong) ?>">
                                        <span class="text-danger"><?= isset($errors['soLuong_error']) ? htmlspecialchars($errors['soLuong_error']) : '' ?></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Giá <span class="login-danger">*</span></label>
                                        <input name="gia" type="number" class="form-control" value="<?= htmlspecialchars($gia) ?>">
                                        <span class="text-danger"><?= isset($errors['gia_error']) ? htmlspecialchars($errors['gia_error']) : '' ?></span>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Danh Mục Sản Phẩm <span class="login-danger">*</span></label>
                                        <select name="maDM" class="form-control">
                                            <?php
                                            $allDM = getAllDM();
                                            foreach ($allDM as $dm) {
                                                echo "<option value='" . $dm['maDM'] . "' " . ($maDM == $dm['maDM'] ? 'selected' : '') . "> " . $dm['tenDM'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="student-submit">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div style="margin-bottom: 50px;"></div>
    <?php require_once './component/footer.php' ?>
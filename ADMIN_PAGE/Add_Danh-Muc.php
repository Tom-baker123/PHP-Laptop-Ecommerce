<?php 
    require_once '../config.php';
    require_once './component/header.php'; 
    require_once './component/slidebar.php'; 
    require_once './ControllerDanhMuc.php'; 
?>
<?php
// Xử lý chèn dữ liệu từ form HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tenDM'])) {
    if ($_POST['tenDM'] != null || $_POST['tenDM'] != '') {
        $result = insertDanhMuc($_POST['tenDM']);

        if ($result == true) {
            echo "<script>alert('Bạn đã thêm thành công!');</script>";
            echo "<script>window.location = 'View_Danh_Muc.php';</script>";
        }
    } else {
        echo "<script>alert('Bạn chưa nhập dữ liệu!');</script>";
    }
}
?>

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Thêm Danh Mục</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Thêm Danh Mục</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label class="col-form-label col-md-2">Tên Danh Mục</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Tên danh mục" name="tenDM">
                                </div>
                            </div>
                            <span ><span class="login-danger">*</span> Lưu ý: </span>
                            <div style="color: gray;"> &ensp;
                                +  Hãy Đảm Bảo Ta không nhập dữ liệu bị trùng trong DB
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div style="margin-bottom: 150px;"></div>
<?php require_once './component/footer.php' ?>
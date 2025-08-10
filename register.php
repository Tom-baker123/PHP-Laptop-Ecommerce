<?php

session_start();
// Chuyển trang về index nếu đã đăng ký.
if (isset($_SESSION['email'])){
  header("location: /index.php");
  exit;
}

// Nếu đã đăng nhập rồi thì khi vô trang đăng ký là chuyển hướng sang trang index luôn

$ho = "";
$ten = "";
$email = "";
$SDT = "";
$ngaySinh = "";
$gioiTinh = "";
$diaChi = "";
$matKhau = "";
$nhapLaiMatKhau = "";
// <?= $ho ? > là viết tắt của từ echo

$ho_error = "";
$ten_error = "";
$email_error = "";
$SDT_error = "";
$ngaySinh_error = "";
$gioiTinh_error = "";
$diaChi_error = "";
$matKhau_error = "";
$nhapLaiMatKhau_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Lấy giá trị từ form
  $ho             = $_POST['ho'];
  $ten            = $_POST['ten'];
  $email          = $_POST['email'];
  $SDT            = $_POST['SDT'];
  $ngaySinh       = $_POST['ngaySinh'];
  $gioiTinh       = $_POST['gioiTinh'];
  // Khu vực nhập địa chỉ
  $diaChi       = $_POST['diaChi'];
  // (End) Khu vực nhập địa chỉ
  $matKhau        = $_POST['matkhau'];
  $nhapLaiMatKhau = $_POST['nhapLaiMatKhau']; // Lấy dữ liệu từ thẻ input bằng post


  /**************** validate Ho ************************/
  if (empty($ho)) {
    $ho_error = " Yêu cầu họ";
    $error = true;
  }

  /**************** validate Ten **********************/
  if (empty($ten)) {
    $ten_error = "* Yêu cầu nhập tên";
    $error = true;
  }

  /**************** validate Email ********************/
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_error = "* Sai định dạng email";
    $error = true;
  }

  /**************** validate SDT **********************/
  if (!preg_match('/^\d{10}$/', $SDT)) {
    $SDT_error = "* SDT Không đúng định dạng!";
    $error = true;
  }

  /**************** validate Ngay Sinh ****************/
  require_once './Controller/ngayThangNamController.php';
  if (!kiemTraNgaySinh($ngaySinh)) {
    $ngaySinh_error = "* Ngày sinh Không hợp lệ.";
    $error = true;
  }

  /**************** validate Ngay Sinh ****************/
  if (empty($diaChi)) {
    $diaChi_error = "* Yêu cầu Địa Chỉ";
    $error = true;
  }


  require 'config.php';

  // Thực thi truy vấn
  $query = "SELECT * FROM KHACHHANG WHERE email = :email";
  $stmt = $pdo->prepare($query);

  // Bind giá trị cho tham số
  $stmt->bindParam(':email', $email);

  // Thực thi email trên
  $stmt->execute();

  // Kiểm tra số lượng bản ghi trả về
  if ($stmt->rowCount() > 0) {
    $email_error = "Email đã tồn tại trong cơ sở dữ liệu.";
    $error = true;
  }



  /**************** validate Mat Khau *****************/
  if (strlen($matKhau) < 6) {
    $matKhau_error = "* Mật khẩu Không đúng định dạng!";
    $error = true;
  }

  /**************** validate Xac Nhan Mat Khau ********/
  if ($nhapLaiMatKhau != $matKhau) {
    $matKhau_error = "* Mật khẩu không khớp!";
    $error = true;
  }

  /**************** Khi Khong con loi nao nua *********/
  if (!$error) {
    /**************** Khu vuc tao user moi **************/
    $matKhau = password_hash($matKhau, PASSWORD_DEFAULT);
    $lay_Id = null;

    try {
      // Tạo truy vấn INSERT với Prepared Statement
      $query = "INSERT INTO KHACHHANG (ho, ten, email, SDT, gioiTinh, ngaySinh, matKhau, diaChi, maVT) 
        VALUES (:ho, :ten, :email, :SDT, :gioiTinh, :ngaySinh, :matKhau, :diaChi, 1)";

      // Chuẩn bị câu lệnh
      $statement = $pdo->prepare($query);
      
      // Bind các tham số
      $statement->bindParam(':ho', $ho, PDO::PARAM_STR);
      $statement->bindParam(':ten', $ten, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':SDT', $SDT, PDO::PARAM_STR);
      $statement->bindParam(':gioiTinh', $gioiTinh, PDO::PARAM_STR);
      $statement->bindParam(':ngaySinh', $ngaySinh, PDO::PARAM_STR);
      $statement->bindParam(':matKhau', $matKhau, PDO::PARAM_STR);
      $statement->bindParam(':diaChi', $diaChi, PDO::PARAM_STR);

      // Thực thi câu lệnh
      $statement->execute();
      
      

      // Lấy ID của bản ghi vừa được chèn
      $lay_Id = $pdo->lastInsertId();
      
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    /**************** Khi Da tao 1 user moi *************/
    // print_r($lay_Id);
    // exit;

    $_SESSION["maKH"]     = $lay_Id;
    $_SESSION['ho']       = $ho;
    $_SESSION['ten']      = $ten;
    $_SESSION['email']    = $email;
    $_SESSION['SDT']      = $SDT;
    $_SESSION['gioiTinh'] = $gioiTinh;
    $_SESSION['ngaySinh'] = $ngaySinh;
    $_SESSION['matKhau']  = $matKhau;
    $_SESSION['diaChi']   = $nhapLaiMatKhau;
    $_SESSION['maVT']     = 1;

    // print_r($_SESSION['email']);
    // exit;

    // Chuyển hướng về trang chủ
    header("Location: /index.php");
    exit;
  }

  // echo "<pre>";
  //   print_r($_POST); // In ra toàn bộ dữ liệu được gửi bằng POST
  // echo "</pre>";
  // echo $lay_Id;
  // exit;
  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
</head>

<body>
  <!-- Start your project here-->
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>

  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
            alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

          <!-- Form xử lý đăng ký -->

          <form method="post">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start pt-3">
              <p class="lead fw-normal mb-0 me-3">ĐĂNG KÝ </p>
            </div>
            <br>

            <div class="d-flex">
              <!-- NHẬP HỌ -->

              <div class="form-outline mb-4 pr-10" style="width: 50%; margin-right: 20px">
                <input type="text" id="form3Example3" class="form-control form-control-lg"
                  placeholder="Nhập Họ" name="ho" value="<?= $ho ?>" />
                <label class="form-label" for="ho">Họ</label>
              </div>
              <!-- NHẬP TÊN -->
              <div class="form-outline mb-4" style="width: 50%">
                <input type="text" id="nhapTen" class="form-control form-control-lg"
                  placeholder="Nhập Tên" name="ten" value="<?= $ten ?>" />
                <label class="form-label" for="nhapTen">Tên</label>
              </div>
            </div>
            <!-- Validation Họ & Tên -->
            <div class="d-flex">
              <span class="text-danger" style="width: 52%;"><?= $ho_error ?></span>
              <span class="text-danger" style="width: 40%;"><?= $ten_error ?></span>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="nhapEmail" class="form-control form-control-lg"
                placeholder="Nhập Địa Chỉ Email hợp lệ" name="email" value="<?= $email ?>" />
              <label class="form-label" for="email">Nhập địa chỉ Email</label>
            </div>
            <!-- Validation -->
            <div>
              <span class="text-danger" style="width: 52%;"><?= $email_error ?></span>
            </div>

            <div class="d-flex">
              <!-- NHẬP SĐT -->
              <div class="form-outline mb-4 pr-10" style="width: 40%; margin-right: 15px">
                <input type="tel" id="nhapSDT" class="form-control form-control-lg"
                  placeholder="Nhập SĐT" name="SDT" value="<?= $SDT ?>" />
                <label class="form-label" for="SDT">SĐT</label>
              </div>

              <!-- CHỌN NGÀY THÁNG NĂM SINH-->
              <div class="form mb-4" style="width: 40%; margin-right: 15px">
                <input type="date" id="date"
                  class="form-control form-control-lg" name="ngaySinh" value="<?= $ngaySinh ?>" />
              </div>
              
              <!-- Chọn giới tính -->
              <div class="form mb-4" style="width: 25%">
                <select name="gioiTinh" id="gioiTinh" class="form-control form-control-lg">
                  <option value="1">Nam</option>
                  <option value="0">Nữ</option>
                </select>
              </div>
            </div>
            <!-- Validation SDT, Ngày Sinh, Giới Tính-->
            <div class="d-flex">
              <span class="text-danger" style="width: 40%;"><?= $SDT_error ?></span>
              <span class="text-danger" style="width: 40%;"><?= $ngaySinh_error ?></span>
              <span class="text-danger" style="width: 25%;"><?= $gioiTinh_error ?></span>
            </div>

            <!-- NHẬP Địa Chỉ -->
            <div class="form-outline mb-3">
              <input type="text" id="nhapDiaChi" class="form-control form-control-lg"
                placeholder="Nhập Địa Chỉ" name="diaChi" value="<?= $diaChi ?>"/>
              <label class="form-label" for="nhapDiaChi">Nhập Địa Chỉ</label>
            </div>
            <!-- Validation Địa Chỉ-->
            <div>
              <span class="text-danger" style="width: 52%;"><?= $diaChi_error ?></span>
            </div>
            
            <!-- NHẬP Password -->
            <div class="form-outline mb-3">
              <input type="password" id="nhapMatKhau" class="form-control form-control-lg"
                placeholder="Nhập mật khẩu" name="matkhau" />
              <label class="form-label" for="nhapMatKhau">Nhập mật khẩu</label>
            </div>
            <!-- Validation Mật Khẩu-->
            <div>
              <span class="text-danger" style="width: 52%;"><?= $matKhau_error ?></span>
            </div>

            <!-- NHẬP Password LẦN 2-->
            <div class="form-outline mb-3">
              <input type="password" id="nhapLaiMatKhau" class="form-control form-control-lg"
                placeholder="Nhập mật khẩu" name="nhapLaiMatKhau" />
              <label class="form-label" for="nhapLaiMatKhau">Nhập lại mật khẩu </label>
            </div>
            <!-- Validation Mật Khẩu-->
            <div>
              <span class="text-danger" style="width: 52%;"><?= $nhapLaiMatKhau_error ?></span>
            </div>

            <!-- Nút Đăng nhập và đăng ký  -->
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">ĐĂNG KÝ</button>
              <a href="index.php" class="btn btn-outline-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem; margin-left: 20px;">
                HỦY
              </a>

              <p class="small fw-bold mt-2 pt-1 mb-0">Đã có tài khoản? <a href="login.php"
                  class="link-danger">Đăng Nhập</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>
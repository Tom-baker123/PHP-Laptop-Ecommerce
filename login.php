<?php

session_start();
// Chuyển trang về index nếu đã đăng nhập.
if (isset($_SESSION['email'])) {
  header("location: /index.php");
  exit;
}

$email = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $matKhau = $_POST['matKhau'];

  if (empty($email) || empty($matKhau)) {
    $error = "Yêu cầu nhập email / mật khẩu vào!";
  } else {

    // Kết nối cơ sở dữ liệu
    require 'config.php';
    
    // Lấy ra email có trong KHACHHANG Table 
    $stmt = $pdo->prepare("SELECT maKH, ho, ten, SDT, gioiTinh, ngaySinh, matKhau, diaChi, maVT FROM KHACHHANG WHERE email = :email");
    // Truyền tham số vào SQL
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    // Thực thi câu lệnh
    $stmt->execute();

    // Kiểm tra xem có dòng truy vấn nào thực thi không?
    if ($stmt->rowCount() > 0) {
      // Lấy một dòng kết quả
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Kiểm tra mật khẩu
      if (password_verify($matKhau, $row['matKhau'])) {
        // Mật khẩu đúng, gán dữ liệu vào session
        $_SESSION['email'] = $email; // Trường email này lấy từ post
        $_SESSION['maKH'] = $row['maKH'];
        $_SESSION['ho'] = $row['ho'];
        $_SESSION['ten'] = $row['ten'];
        $_SESSION['SDT'] = $row['SDT'];
        $_SESSION['gioiTinh'] = $row['gioiTinh'];
        $_SESSION['ngaySinh'] = $row['ngaySinh'];
        $_SESSION['diaChi'] = $row['diaChi'];
        $_SESSION['maVT'] = $row['maVT'];

        // Chuyển hướng về trang chủ:
        header("location: /index.php");
        exit;
      } else {
        $error = "Mật khẩu không đúng";
      }
    } else {
      $error = "Email không tồn tại";
    }
  }
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

          <!-- FORM ĐĂNG NHẬP -->
          <form class="user" action="#" method="post">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="lead fw-normal mb-0 me-3">Đăng nhập với</p>
              <button type="button" onclick="alert('Đang Đăng nhập!')" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
              </button>

              <button type="button" onclick="alert('Đang Đăng nhập!')" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-twitter"></i>
              </button>

              <button type="button" onclick="alert('Đang Đăng nhập!')" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-linkedin-in"></i>
              </button>
            </div>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Or</p>
            </div>


            <!-- "empty": Kiểm tra xem có rỗng ko -->
            <!-- Kiểm tra biến error có chuỗi lỗi không? -->
            <?php if (!empty($error)) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input name="email" type="email" id="nhapEmail" class="form-control form-control-lg"
                placeholder="Nhập Địa Chỉ Email hợp lệ" value="<?= $email ?>" />
              <label class="form-label" for="nhapEmail">Nhập địa chỉ Email</label>
            </div>

            <!-- NHẬP Password -->
            <div class="form-outline mb-3">
              <input name="matKhau" type="password" id="nhapMatKhau" class="form-control form-control-lg"
                placeholder="Nhập mật khẩu" />
              <label class="form-label" for="nhapMatKhau">Nhập mật khẩu</label>
            </div>


            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Ghi nhớ tôi
                </label>
              </div>
              <a href="#!" class="text-body">Quên mật khẩu?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button name="btnSubmit" type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">ĐĂNG NHẬP</button>

              <a href="index.php" class="btn btn-outline-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem; margin-left: 20px;">
                HỦY
              </a>
              <p class="small fw-bold mt-2 pt-1 mb-0">Chưa có tài khoản? <a href="register.php"
                  class="link-danger">Đăng Ký</a></p>
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
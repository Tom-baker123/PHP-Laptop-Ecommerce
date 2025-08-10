<?php
require '../config.php';
// -------------Lấy Tên Cột----------------
function getTenCot($tenBang)
{
    try {
        global $pdo;
        // Biến tất cả thành chữ hoa hết:
        $tenBang = strtoupper($tenBang);

        // Gán truy vấn vào 1 biến 
        // + LẤY TABLE TỪ THAM SỐ VÀ CHỈ 1 DÒNG DỮ LIỆU.
        $sql = "SELECT * FROM $tenBang LIMIT 1";
        // Chuẩn bị và thực thi truy vấn
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Lấy thông tin cột:
        $tenColumn = [];
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $cot = $stmt->getColumnMeta($i); // Lấy từng cột
            $tenColumn[] = $cot['name'];
        }


        return $tenColumn; // Trả về tên các cột
    } catch (PDOException $e) {
        // Bắt lỗi và in ra thông báo
        die("Lỗi truy vấn: " . $e->getMessage());
    }
}

// Hàm lấy tất cả sản phẩm:
function getMotDM($tenBang1, $maCanTim)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT tenDM FROM $tenBang1 WHERE maDM = $maCanTim");
    $stmt->execute(); // Nhớ thêm dòng này vào.
    $DM = $stmt->fetch();

    echo $DM['tenDM'];
}

// Hàm lấy tất cả sản phẩm:
function getAllSP($tenBang1, $tenBang2, $maLienKet)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM $tenBang1 s1 LEFT JOIN $tenBang2 s2 ON s1.$maLienKet = s2.$maLienKet");
    $stmt->execute(); // Nhớ thêm dòng này vào.
    $allSP = $stmt->fetchAll();

    return $allSP;
}

// Hàm lấy tất cả sản phẩm:
function getAllDM()
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM DANHMUCSANPHAM");
    $stmt->execute(); // Nhớ thêm dòng này vào.
    return $stmt->fetchAll();
}

function insertHinhAnh($duongDan, $maSP){
    global $pdo;
    $sql = "INSERT INTO HINHANH (duongDan, maSP) VALUES (:duongDan, :maSP)";    
    try{
        $stmt = $pdo->prepare($sql);
        // Sử dụng bindParam để ràng buộc các tham số
        $stmt->bindParam(':duongDan', $duongDan, PDO::PARAM_STR);
        $stmt->bindParam(':maSP', $maSP, PDO::PARAM_INT);
        $stmt->execute();
    }catch (PDOException $e){
        die("Lỗi khi chèn dữ liệu: " . $e->getMessage());
    }
}

// Hàm chèn Data cho table sản phẩm:
function insertSanPham($tenSP, $moTa, $soLuong, $gia, $maDM)
{
    global $pdo;
    $sql = "INSERT INTO SANPHAM (tenSP, moTa, soLuong, gia, maDM) VALUES (:tenSP, :moTa, :soLuong, :gia, :maDM)";

    try {
        $stmt = $pdo->prepare($sql);
        // Sử dụng bindParam để ràng buộc các tham số
        $stmt->bindParam(':tenSP',  $tenSP, PDO::PARAM_STR);
        $stmt->bindParam(':moTa',   $moTa, PDO::PARAM_STR);
        $stmt->bindParam(':soLuong', $soLuong, PDO::PARAM_INT);
        $stmt->bindParam(':gia',    $gia, PDO::PARAM_STR);
        $stmt->bindParam(':maDM',   $maDM, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về mã sản phẩm vừa mới chèn để tạo một đường dẫn ảo
        return $maSP = $pdo->lastInsertId();;
    } catch (PDOException $e) {
        die("Lỗi khi chèn dữ liệu: " . $e->getMessage());
    }
    return null;
}

// Hàm kiểm tra tên Data có bị trùng không:
function checkSQLTenSP($_name)
{
    $nameVa = "%" . $_name . "%";

    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM SANPHAM WHERE tenSP LIKE :tenSP");
    $stmt->bindParam(':tenSP', $nameVa, PDO::PARAM_STR);
    $stmt->execute(); // Nhớ thêm dòng này vào.
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        return false;
    }
    return true;
}

function validationSPError($tenSP, $moTa, $soLuong, $gia, $maDM)
{
    $errors = [];

    // Kiểm tra tên sản phẩm
    if (empty($tenSP)) { $errors['tenSP_error'] = "Yêu cầu nhập tên SP"; }

    // Kiểm tra mô tả sản phẩm
    if (empty($moTa)) { $errors['moTa_error'] = "Yêu cầu nhập mô tả cho SP"; }

    // Kiểm tra số lượng sản phẩm
    if (empty($soLuong) || $soLuong < 0) { $errors['soLuong_error'] = "Yêu cầu ko để trống & 
                                                                       nhập số lượng không được âm"; }

    // Kiểm tra giá sản phẩm
    if (empty($gia) || $gia < 0) { $errors['gia_error'] = "Yêu cầu ko để trống & nhập giá không được âm"; }

    return !empty($errors) ? $errors : false;
}


function getInputPostAndInsert($tenSP, $moTa, $soLuong, $gia, $maDM)
{
    global $pdo;

    // Xử lý chèn dữ liệu từ form HTML
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra lỗi đầu vào
        $errors = validationSPError($tenSP, $moTa, $soLuong, $gia, $maDM);
        
        if ($errors) {
            // Nếu có lỗi, hiển thị thông báo lỗi
            return $errors;
        }

        // Kiểm tra xem tên SP nhập vào có bị trùng không?
        if (checkSQLTenSP($tenSP) === false) {
            echo "<script> alert('Tên sản phẩm của bạn đã bị trùng!'); </script>";
        } else {
            $result_1 = insertSanPham($tenSP, $moTa, $soLuong, $gia, $maDM);
            echo "<script>
                    alert('Bạn đã thêm thành công! Đồng thời bạn cần chọn ảnh cho sản phẩm đó');
                    window.location = 'Add_Hinh_Anh.php?maSP=$result_1';
                  </script>";
            // $result_2 = insertHinhAnh($tenSP, $moTa, $soLuong, $gia, $maDM);

            if ($result_1 != null) {
                echo "<script>
                        alert('Bạn đã thêm thành công! Đồng thời bạn cần chọn ảnh cho sản phẩm đó');
                        window.location = 'View_San_Pham.php';
                      </script>";
            } else {
                echo "<script>alert('Sản phẩm không thêm được!');</script>";
            }
        }
    }
}


<?php
function kiemTraNgaySinh($ngaySinh) {
    // Kiểm tra nếu ngày trống
    if (empty($ngaySinh)) {
        return "Ngày sinh không được để trống.";
    }

    // Kiểm tra định dạng ngày (YYYY-MM-DD) với regex
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $ngaySinh)) {
        return "Định dạng ngày không hợp lệ. Vui lòng nhập theo định dạng YYYY-MM-DD.";
    }

    // Tách ngày tháng năm
    list($year, $month, $day) = explode("-", $ngaySinh);

    // Kiểm tra ngày hợp lệ với hàm checkdate
    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        return "Ngày sinh không hợp lệ.";
    }

    // Kiểm tra ngày sinh không lớn hơn ngày hiện tại
    $ngayHienTai = date("Y-m-d");
    if ($ngaySinh > $ngayHienTai) {
        return "Ngày sinh không được lớn hơn ngày hiện tại.";
    }

    return true; // Ngày hợp lệ
}
?>

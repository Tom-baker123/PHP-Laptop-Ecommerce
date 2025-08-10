<?php
    require_once '../config.php';

    // Hàm lấy tất cả sản phẩm:
    function getAllSP()
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM SANPHAM");
        $stmt->execute(); // Nhớ thêm dòng này vào.
        return $stmt->fetchAll();
    }
    
    function insertHinhAnh() {
        global $pdo;
        $sql = "INSERT INTO HINHANH (duongDan, maSP) VALUES (:duongDan, :maSP)";

    }
?>
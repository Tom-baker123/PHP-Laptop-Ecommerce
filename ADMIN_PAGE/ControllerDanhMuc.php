<?php
require_once '../config.php';

    function insertDanhMuc($tenDM) {
        global $pdo;

        $sql = "INSERT INTO DANHMUCSANPHAM (tenDM) VALUES (:tenDM)";
        try {
            $stmt = $pdo->prepare($sql);
            // Sử dụng bindParam để ràng buộc các tham số
            $stmt->bindParam(':tenDM', $tenDM, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Lỗi khi chèn dữ liệu: " . $e->getMessage());
        }
        return false;
    }
?>
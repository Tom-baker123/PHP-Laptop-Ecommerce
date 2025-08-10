<?php
function getRandomProductDE($pdo) {
    $sql = "SELECT * FROM SANPHAM sp
            LEFT JOIN HINHANH ha ON sp.maSP = ha.maSP
            ORDER BY RAND()
            LIMIT 6;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
}
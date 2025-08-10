<?php
require_once 'config.php';

// shopFunction.php

function getPaginationData($pdo, $maDM = null, $limit = 6) {
    // Truy vấn tổng số sản phẩm
    $sql = "SELECT COUNT(*) FROM SANPHAM WHERE 1=1";
    if ($maDM) {
        $sql .= " AND maDM = :maDM";
    }
    $stmt = $pdo->prepare($sql);
    if ($maDM) {
        $stmt->bindValue(':maDM', $maDM, PDO::PARAM_INT);
    }
    $stmt->execute();
    $totalProducts = $stmt->fetchColumn();
    $totalPages = ceil($totalProducts / $limit);

    return [
        'totalProducts' => $totalProducts,
        'totalPages' => $totalPages,
    ];
}

function getProducts($pdo, $maDM = null, $page = 1, $limit = 6) {
    $offset = ($page - 1) * $limit;

    $sql = "SELECT sp.*, dm.tenDM, ha.duongDan 
            FROM SANPHAM sp
            JOIN DANHMUCSANPHAM dm ON sp.maDM = dm.maDM
            LEFT JOIN HINHANH ha ON sp.maSP = ha.maSP
            WHERE 1=1 ";
    if ($maDM) {
        $sql .= " AND sp.maDM = :maDM";
    }
    $sql .= " LIMIT :offset, :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    if ($maDM) {
        $stmt->bindValue(':maDM', $maDM, PDO::PARAM_INT);
    }
    $stmt->execute();

    return $stmt->fetchAll();
}


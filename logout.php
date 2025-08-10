<?php
    // Khởi tạo sesion:
    session_start();

    // Unset các biến sesion: (Tạo thành mãng rỗng )
    $_SESSION = array();

    // Hủy biến Session:
    session_destroy();

    // Chuyển trang về index:
    header("location: /index.php");

?>
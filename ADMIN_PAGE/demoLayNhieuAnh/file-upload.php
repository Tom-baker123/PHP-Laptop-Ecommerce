<?php 
//them sanpham

//lay id san pham vua them
$id=10;
for($i=0; $i< count($_FILES['userfile']['name']); $i++)
{
    $f1 ='img/'. $_FILES['userfile']['name'][$i];
    $f2 = $_FILES['userfile']['tmp_name'][$i];
    move_uploaded_file($f2, $f1);
    $sql ="insert into hinhanh (duongdan, masp) values('$f1', '$id')";
    echo "<br>$sql";
}
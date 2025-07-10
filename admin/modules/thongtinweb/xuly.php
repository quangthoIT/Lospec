<?php 
include('../../config/config.php');

$thongtinlienhe = $_POST['thongtinlienhe'];
$gioithieu = $_POST['gioithieu'];
$id = $_GET['id'];

if(isset($_POST['submitlienhe'])){
    $sql_update = "UPDATE tbl_lienhe SET thongtinlienhe='".$thongtinlienhe."', gioithieu='".$gioithieu."' WHERE id_lienhe='$id'";
    mysqli_query($mysqli,$sql_update);
    header('Location:../../index.php?action=quanlyweb&query=capnhat');
}
?>
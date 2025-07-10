<?php 
    include('../../admin/config/config.php');
    $product_id = $_POST['product_id'];
    $sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham = '$product_id' LIMIT 1";
    $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
    $result = mysqli_fetch_array($query_chitiet);
    $data_array = []; 

    $data_array = $result;
    echo json_encode($data_array);
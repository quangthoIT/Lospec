<h1>Chi tiết sản phẩm</h1>
<?php
    $sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham = '$_GET[id]' LIMIT 1";
    $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
    while($row_chitiet= mysqli_fetch_array($query_chitiet)){

?>
<div class="wrapper_chitiet">
    <div class="hinhanh_sanpham">
        <img width="80%" src="admin/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh']?>">
    </div>
    <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham']?>">
        <div class="chitiet_sanpham">
            <h3>Tên sản phẩm : <?php echo $row_chitiet['tensanpham']?></h3>
            <p>Mã sản phẩm : <b><?php echo $row_chitiet['masp']?></b></p>
            <?php
            if($row_chitiet['soluong']>10){
            ?>
                <p>Số lượng sản phẩm : <b><?php echo $row_chitiet['soluong']?></b></p>
            <?php
            }else{
            ?>
                <p>Số lượng sản phẩm chỉ còn : <b><?php echo $row_chitiet['soluong']?></b></p>
            <?php
            }    
            ?>
            <p>Giá sản phẩm :<b> <?php echo number_format($row_chitiet['giasp'],0,',','.').' VNĐ' ?></b></p>
            <p>Hãng: <b><?php echo $row_chitiet['tendanhmuc']?></b></p>
            <?php
            if($row_chitiet['soluong']>1){
            ?>
                <!-- <p><input class="themgiohang" type="submit" name="themgiohang" value="Thêm giỏ hàng"></p> -->
                <p><button type="submit" name="themgiohang" class="btn btn-danger">Thêm giỏ hàng</button></p>
            <?php
            }else{
            ?>
            <p style="color:red; font-weight:700;font-size:25px;"><b>HẾT HÀNG</b></p>
            <?php
            }    
            ?>
        </div>
    </form>
</div>

<div class="clear"></div>

<div class="tabs">
  <ul id="tabs-nav">
    <li><a href="#tab1">Thông số kỹ thuật</a></li>
    <li><a href="#tab2">Nội dung chi tiết</a></li>
    <li><a href="#tab3">Hình ảnh</a></li>
  </ul> <!-- END tabs-nav -->
  <div id="tabs-content">
    <div id="tab1" class="tab-content">
        <p><?php echo $row_chitiet['tomtat']?></p>
    </div>
    <div id="tab2" class="tab-content">
        <p><?php echo $row_chitiet['noidung']?></p>
    </div>
    <div id="tab3" class="tab-content">
        <img width="80%" src="admin/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh']?>">
    </div>
  </div> <!-- END tabs-content -->
</div> <!-- END tabs -->

<?php
}
?>
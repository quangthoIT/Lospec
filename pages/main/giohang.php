
<?php 
    if(isset($_SESSION['cart'])){
    }
?>
<?php
if (isset($_SESSION['dangky'])) {
  ?>
    <div class="containerr">	
        <div class="arrow-steps clearfix">
            <div class="step current"><span> <a href="index.php?quanly=giohang">Giỏ hàng</a> </span> </div>
            <div class="step"> <span><a href="index.php?quanly=vanchuyen">Vận chuyển</a> </span> </div>
            <div class="step"> <span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a> </span> </div>
            <div class="step"> <span><a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a></span> </div>
        </div>
    </div>
<?php
}
?>
<table style="width:100%; text-align:center; border-collapse:collapse;" border="1";">
  <tr>
    <th>ID</th>
    <th>Mã sản phẩm</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th>Thành tiền</th>
    <th>Quản lý</th>
  </tr>
  <?php
  if(isset($_SESSION['cart'])){
    $i=0;
    $tongtien = 0;
    foreach($_SESSION['cart'] as $cart_item){
        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
        $tongtien +=$thanhtien;
        $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $cart_item['masp'] ?></td>
    <td><?php echo $cart_item['tensanpham'] ?></td>
    <td><img src="admin/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']?>" width="100px";height:100px</td>
    <td>
      <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id']?>"><i class="fa fa-minus"></i></a>
      <?php echo $cart_item['soluong'] ?>
      <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id']?>"><i class="fa fa-plus"></i></a>

    </td>
    <td><?php echo number_format($cart_item['giasp'],0,',','.').' VNĐ'  ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').' VNĐ' ?></td>
    <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id']?>">Xóa</a></td>
  </tr>
  <?php
    }
  ?>
  <tr>
    <td colspan="8">
      <p style="float:left;"><b>Tổng tiền: <?php echo number_format($tongtien,0,',','.').' VNĐ' ?> </b></p>
      <p style="float:right;"><a href="pages/main/themgiohang.php?xoatatca=1">Xóa tất cả sản phẩm</a></p>
      <div style="clear: both;"></div>
      <?php 
        if(isset($_SESSION['dangky'])){
        ?>
          <p><button class="btn btn-success"><a style="color:white;" href="index.php?quanly=vanchuyen">Hình thức vận chuyển</a></button></p>
      <?php
        }else{
      ?>
          <p><button class="btn btn-success"><a style="color:white;" href="index.php?quanly=dangky">Đăng ký đặt hàng</a></button></p>
      <?php
        }
      ?>   
      
    </td>
  </tr>
  <?php
  }else{
  ?>
    <tr>
      <td colspan="8"><p>Hiện tại giỏ hàng trống</p></td>
    </tr>
  <?php
  }
  ?>
</table>

<div class="containerr">	
        <div class="arrow-steps clearfix">
              <div class="step "><span> <a href="index.php?quanly=giohang">Giỏ hàng</a> </span> </div>
              <div class="step current"> <span><a href="index.php?quanly=vanchuyen">Vận chuyển</a> </span> </div>
              <div class="step "> <span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a> </span> </div>
              <div class="step "> <span><a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a></span> </div>
        </div>      
</div>

<h4>Thông tin vận chuyển</h4>
<?php 
      if(isset($_POST['themvanchuyen'])){
            $name= $_POST['name'];
            $phone= $_POST['phone'];
            $address= $_POST['address'];
            $note= $_POST['note'];
            $id_dangky = $_SESSION['id_khachhang'];
            $sql_them_vanchuyen = mysqli_query($mysqli,"INSERT INTO tbl_shipping(ten,phone,diachi,ghichu,id_dangky) VALUE('$name','$phone','$address','$note','$id_dangky')");
            if($sql_them_vanchuyen){
                  echo '<script>alert("Đăng kí thông tin vận chuyển thành công")</script>';
            }
      }elseif(isset($_POST['capnhatvanchuyen'])){
        $name= $_POST['name'];
        $phone= $_POST['phone'];
        $address= $_POST['address'];
        $note= $_POST['note'];
        $id_dangky = $_SESSION['id_khachhang'];

        $sql_update_vanchuyen = mysqli_query($mysqli,"UPDATE tbl_shipping SET ten='$name',phone='$phone',diachi='$address',ghichu='$note',id_dangky='$id_dangky' WHERE id_dangky='$id_dangky'");
        if($sql_update_vanchuyen){
          echo '<script>alert("Cập nhật thông tin vận chuyển thành công")</script>';
    }
      }
?>

<div class="row">
      <?php
      $id_dangky = $_SESSION['id_khachhang'];
      $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1"); 
      $count = mysqli_num_rows($sql_get_vanchuyen);
      if($count > 0){
        $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
        $name= $row_get_vanchuyen['ten'];
        $phone= $row_get_vanchuyen['phone'];
        $address= $row_get_vanchuyen['diachi'];
        $note= $row_get_vanchuyen['ghichu'];
      }else{
        $name= '';
        $phone= '';
        $address= '';
        $note= '';
      }
      ?>


      <div class="col-md-12">
            <form action="" autocomplete="off" method="POST">
                  <div class="form-group">
                        <label for="email">Họ và tên:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name ?>"  placeholder="Nhập họ tên.....">
                  </div>
                  <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>" placeholder="Nhập số điện thoại.....">
                  </div>
                  <div class="form-group">
                        <label for="email">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address ?>" placeholder="Nhập địa chỉ.....">
                  </div>
                  <div class="form-group">
                        <label for="email">Ghi chú:</label>
                        <input type="text" name="note" class="form-control" value="<?php echo $note ?>" placeholder="Nhập ghi chú....">
                  </div>
                  <?php
                  if($name=='' && $phone==''){
                  ?>
                  <button class="btn btn-primary" type="text" name="themvanchuyen" class="form-control" placeholder="Nhập ghi chú....">Thêm thông tin vận chuyển</button>
                  <?php
                  }elseif($name!='' && $phone!=''){
                  ?>
                  <button class="btn btn-primary" type="text" name="capnhatvanchuyen" class="form-control" placeholder="Nhập ghi chú....">Cập nhật thông tin vận chuyển</button>
                  <?php
                  }
                  ?>
            </form>
      </div>
</div>
<table style="width:100%; text-align:center; border-collapse:collapse; margin-top:10px;" border="1" ">
  <tr>
    <th>ID</th>
    <th>Mã sản phẩm</th>
    <th>Tên sản phẩm</th>
    <th>Hình ảnh</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th>Thành tiền</th>
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
    <td><?php echo $cart_item['soluong'] ?></td>
    <td><?php echo number_format($cart_item['giasp'],0,',','.').' VNĐ'  ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').' VNĐ' ?></td>
  </tr>
  <?php
    }
  ?>
  <tr>
    <td colspan="8">
      <p style="float:left;"><b>Tổng tiền: <?php echo number_format($tongtien,0,',','.').' VNĐ' ?></b> </p>
      <div style="clear: both;"></div>
      <?php 
        if(isset($_SESSION['dangky'])){
        ?>
          <p><button class="btn btn-success"><a style="color:#fff;" href="index.php?quanly=thongtinthanhtoan">Thanh toán</a></button></p>
      <?php
        }
      ?>   
    </td>
  </tr>
  <?php
  }
  ?>
</table>
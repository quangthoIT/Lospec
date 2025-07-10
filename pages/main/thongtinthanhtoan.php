
<div class="containerr">	
        <div class="arrow-steps clearfix">
              <div class="step "><span> <a href="index.php?quanly=giohang">Giỏ hàng</a> </span> </div>
              <div class="step"> <span><a href="index.php?quanly=vanchuyen">Vận chuyển</a> </span> </div>
              <div class="step current"> <span><a href="index.php?quanly=thongtinthanhtoan">Thanh toán</a> </span> </div>
              <div class="step "> <span><a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a></span> </div>
        </div>
</div>

<form action="pages/main/xulythanhtoan.php" method="POST">
      <div class="row">
            <div class="col-md-8">
            <h3>Thông tin vận chuyển và đơn hàng</h3> 
            <?php
            $id_dangky = $_SESSION['id_khachhang'];
            $sql_lh = "SELECT * FROM tbl_shipping WHERE id_dangky='$id_dangky' LIMIT 1";
            $query_lh = mysqli_query($mysqli,$sql_lh);

            ?>
            <?php
            while($dong = mysqli_fetch_array($query_lh)){
            ?>
            <p>Người đặt hàng: <b><?php echo $dong['ten']?></b> </p>
            <p>Số điện thoại: <b><?php echo $dong['phone']?></b></p>
            <p>Địa chỉ: <b><?php echo $dong['diachi']?></b></p>
            <p>Ghi chú: <b><?php echo $dong['ghichu']?></b></p>
            <?php
            }
            ?>
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
                        <p style="float:left;"><b>Tổng tiền: <?php echo number_format($tongtien,0,',','.').' VNĐ' ?></b></p>
                        <input type="hidden" name="" value="<?php echo round($tongtien / 24000); ?>" id="tongtien">
                        <div style="clear: both;"></div>
                  </td>
            </tr>
            <?php
            }
            ?>
            </table>
            </div>

            <div class="col-md-4">
                  <h3>Hình thức thanh toán</h3>
                  <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tienmat" checked>
                        <img class="img img-responsive" src="images/money-bill.jpg" style="width:30px;height:30px;">
                        <label class="form-check-label" for="exampleRadios1">
                        Tiền mặt
                  </label>
                  </div>
                  <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyenkhoan" >
                        <img class="img img-responsive" src="images/nganhang.png" style="width:30px;height:30px;">
                        <label class="form-check-label" for="exampleRadios2">
                        Chuyển khoản
                  </label>
                  </div>
                  <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="exampleRadios4" value="vnpay" >
                        <img class="img img-responsive" src="images/vnpay.jpg" style="width:30px;height:30px;">
                        <label class="form-check-label" for="exampleRadios4">
                        Ví VNPAY
                  </label>
                  </div>
                  <div id="paypal-button-container"></div>
                  <input type="submit" value = "Thanh toán" name="redirect" class="btn btn-danger" style="margin-top:10px;">
            </div>
      </div>
</form>


                  



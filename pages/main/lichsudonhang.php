
<?php
    $id_khachhang= $_SESSION['id_khachhang'];
    $sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky AND tbl_cart.id_khachhang = '$id_khachhang' ORDER BY tbl_cart.id_cart DESC";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
?>

<table border="1" width="100%" style="border-collapse:collapse;" >
    <tr>
        <th>Id</th>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Tình trạng</th>
        <th>Ngày đặt</th>
        <th>Xem đơn hàng</th>
        <th>Hình thức thanh toán</th>
    </tr>
    <?php 
    $i = 0;
    while($row= mysqli_fetch_array($query_lietke_dh)){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['code_cart'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td>
            <?php if($row['cart_status']==0){
                echo 'Chưa xử lý';
            }else{
                echo 'Xác nhận đã thanh toán COD';
            }
            ?>
        </td>
        <td><?php echo $row['cart_date'] ?></td>
        <td>
            <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem</a> 
        </td>
        <td>
            <?php 
            if($row['cart_payment']=='vnpay'){
            ?>
            <a href="index.php?quanly=lichsudonhang&congthanhtoan=<?php echo $row['cart_payment'] ?>&code_cart=<?php echo $row['code_cart'] ?>"><?php echo $row['cart_payment'] ?></a>
            <?php
            }else{
            ?>
            <?php echo $row['cart_payment'] ?>
            <?php
            }
            ?>
        </td>
    </tr>
    <?php
    }
    ?>

</table>
<?php
if(isset($_GET['congthanhtoan'])){
    $congthanhtoan=$_GET['congthanhtoan'];
    $code_cart=$_GET['code_cart'];
    echo '<h4>Chi tiết thanh toán: '.$congthanhtoan.' </h4>';
    if($congthanhtoan=='vnpay'){
        $sql_vnpay = mysqli_query($mysqli,"SELECT * FROM tbl_vnpay WHERE code_cart='$code_cart' LIMIT 1");
        $row_vnpay = mysqli_fetch_array($sql_vnpay);
    ?>
    <table class="table">
    <thead>
      <tr>
        <th>Amount</th>
        <th>BankCode</th>
        <th>BankTranNo</th>
        <th>CardType</th>
        <th>OrderInfo</th>
        <th>PayDate</th>
        <th>TmnCode</th>
        <th>TransactionNo</th>
        <th>CodeCart</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $row_vnpay['vnp_amount']?></td>
        <td><?php echo $row_vnpay['vnp_bankcode']?></td>
        <td><?php echo $row_vnpay['vnp_banktranno']?></td>
        <td><?php echo $row_vnpay['vnp_cardtype']?></td>
        <td><?php echo $row_vnpay['vnp_orderinfo']?></td>
        <td><?php echo $row_vnpay['vnp_paydate']?></td>
        <td><?php echo $row_vnpay['vnp_tmncode']?></td>
        <td><?php echo $row_vnpay['vnp_transactionno']?></td>
        <td><?php echo $row_vnpay['code_cart']?></td>
      </tr>
    </tbody>
  </table>
  <?php
    }
   ?>
<?php
}
?>
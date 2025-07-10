<?php
    include('admin/config/config.php');
    require('./lib/carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $now = Carbon::now('Asia/Ho_Chi_Minh');


if (isset($_GET['vnp_Amount'])) {
    $vnp_respon = $_GET['vnp_ResponseCode'];
    if ($vnp_respon == '00') {
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_TmnCode = $_GET['vnp_TmnCode'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
        $vnp_CardType = $_GET['vnp_CardType'];

        $code_cart = $_SESSION['code_cart'];

        $insert_vnpay = "INSERT INTO tbl_vnpay(vnp_amount,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderinfo,vnp_paydate,vnp_tmncode,vnp_transactionno,code_cart)
                VALUE('" . $vnp_Amount . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "','" . $vnp_TransactionNo . "','" . $code_cart . "')";
        $cart_query = mysqli_query($mysqli, $insert_vnpay);
        unset($_SESSION['cart']);
        if ($cart_query) {
            echo '<h3>Giao dịch VNPAY thành công</h3>';
            echo '<h3>Vui lòng vào trang <a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</h3>';
            echo '<h2><i>Cảm ơn đã mua hàng!! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</i></h2>';
        }
    }else{
        $code_cart = $_SESSION['code_cart'];
        $sql_xoa = "DELETE FROM tbl_cart WHERE code_cart='".$code_cart."' ";
        mysqli_query($mysqli,$sql_xoa);

        $sql_xoa_detail = "DELETE FROM tbl_cart_details WHERE code_cart='".$code_cart."' ";
        mysqli_query($mysqli,$sql_xoa_detail);
        echo '<h3>Giao dịch thất bại</h3>';
    }
}else if(isset($_GET['thanhtoan'])=='paypal'){
    $code_oder = rand(0,9999);
    $cart_payment = 'paypal';
    $id_khachhang=$_SESSION['id_khachhang'];

    $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_khachhang' LIMIT 1");
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $id_shipping = $row_get_vanchuyen['id_shipping'];

    $tongtien=0;
    foreach($_SESSION['cart'] as $key =>$value){
        $thanhtien = $value['soluong'] * $value['giasp'];
        $tongtien +=$thanhtien;

    }
    $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart, cart_status,cart_date,cart_payment,cart_shipping) VALUE('".$id_khachhang."','".$code_oder."',0,'".$now."','".$cart_payment."','".$id_shipping."')";
    $cart_query = mysqli_query($mysqli,$insert_cart);

    foreach($_SESSION['cart'] as $key =>$value){
        $id_sanpham= $value['id'];
        $soluong = $value['soluong'];
        $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham,code_cart,soluongmua) VALUE ('".$id_sanpham."','".$code_oder."','".$soluong."')";
        mysqli_query($mysqli,$insert_order_details);
        
        //quản lý số lượng sản phẩm còn lại trong kho hàng
        $sql_chitiet = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_sanpham = '$id_sanpham' LIMIT 1";
        $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
        while($row_chitiet= mysqli_fetch_array($query_chitiet)){
            $soluongtong= $row_chitiet['soluong'];
            $soluongcon = $soluongtong - $soluong;
            $soluongbanra = $row_chitiet['soluongban'] +  $soluong;
        }        
        //cập nhật lại số lượng hàng trong kho  
        $sql_update_sl = "UPDATE tbl_sanpham SET soluong='".$soluongcon."', soluongban='".$soluongbanra."' WHERE id_sanpham='$id_sanpham'";
        $queryy = mysqli_query($mysqli,$sql_update_sl);
    }
    if ($queryy) {
        echo '<h3>Giao dịch PAYPAL thành công</h3>';
        echo '<h3>Vui lòng vào trang <a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</h3>';
        echo '<h2><i>Cảm ơn đã mua hàng!! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</i></h2>';
        unset($_SESSION['cart']);

    }
} else {
    echo '<h2><i>Cảm ơn đã mua hàng!! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</i></h2>';
    echo '<h2>Vui lòng vào trang <a href="index.php?quanly=donhangdadat">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</h2>';
}
?>
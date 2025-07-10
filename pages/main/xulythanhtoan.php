<?php
    session_start();
    include('../../admin/config/config.php');
    require('../../lib/carbon/autoload.php');
    require_once('config_vnpay.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $now = Carbon::now('Asia/Ho_Chi_Minh');
    $id_khachhang=$_SESSION['id_khachhang'];
    $code_oder = rand(0,9999);
    $cart_payment = $_POST['payment'];

    $sql_get_vanchuyen = mysqli_query($mysqli,"SELECT * FROM tbl_shipping WHERE id_dangky='$id_khachhang' LIMIT 1");
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $id_shipping = $row_get_vanchuyen['id_shipping'];
    $tongtien=0;
    foreach($_SESSION['cart'] as $key =>$value){
        $thanhtien = $value['soluong'] * $value['giasp'];
        $tongtien +=$thanhtien;
    }


    if($cart_payment=='tienmat' || $cart_payment=='chuyenkhoan'){
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
            mysqli_query($mysqli,$sql_update_sl);

        }
        header('Location:../../index.php?quanly=camon');

    }elseif($cart_payment=='vnpay'){
        $vnp_TxnRef = $code_oder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = 'Thanh toán đơn hàng tại Website';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $tongtien * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $vnp_ExpireDate = $expire;

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            $_SESSION['code_cart']= $code_oder;

            $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart, cart_status,cart_date,cart_payment,cart_shipping) VALUE('".$id_khachhang."','".$code_oder."',0,'".$now."','".$cart_payment."','".$id_shipping."')";
            $cart_query = mysqli_query($mysqli,$insert_cart);
        
            foreach($_SESSION['cart'] as $key =>$value){
                $id_sanpham= $value['id'];
                $soluong = $value['soluong'];
                $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham,code_cart,soluongmua) VALUE ('".$id_sanpham."','".$code_oder."','".$soluong."')";
                mysqli_query($mysqli,$insert_order_details);
            }
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

    }
    unset($_SESSION['cart']);
?>
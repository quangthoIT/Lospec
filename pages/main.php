<?php
if (isset($_GET['quanly'])) {
    $tam = $_GET['quanly'];

    // Redirect if needed
    if ($tam == 'dangky' || $tam == 'dangnhap') {
        echo "<script>window.location.href = 'dangky-dangnhap.php';</script>";
        exit(); 
    }
} else {
    $tam = '';
}

?>

<div id="main" style="width:99%;">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <?php 
            include("sidebar/sidebar.php");
            ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="maincontent">
                <?php
                if(isset($_GET['quanly'])){
                    $tam=$_GET['quanly'];
                }
                else{
                    $tam='';
                }
                if($tam=='danhmucsanpham'){
                    include("main/danhmuc.php");
                }elseif($tam=='giohang'){
                    include("main/giohang.php");
                }elseif($tam=='danhmucbaiviet'){
                    include("main/danhmucbaiviet.php");
                }elseif($tam=='baiviet'){
                    include("main/baiviet.php");
                }elseif($tam=='tintuc'){
                    include("main/tintuc.php");
                }elseif($tam=='gioithieu'){
                    include("main/gioithieu.php");
                }elseif($tam=='lienhe'){
                    include("main/lienhe.php");
                }elseif($tam=='sanpham'){
                    include("main/sanpham.php");
                }elseif($tam=='thanhtoan'){
                    include("main/thanhtoan.php");
                }elseif($tam=='timkiem'){
                    include("main/timkiem.php");
                }elseif($tam=='camon'){
                    include("main/camon.php");
                }elseif($tam=='thongtinthanhtoan'){
                    include("main/thongtinthanhtoan.php");
                }elseif($tam=='vanchuyen'){
                    include("main/vanchuyen.php");
                }elseif($tam=='donhangdadat'){
                    include("main/donhangdadat.php");
                }elseif($tam=='lichsudonhang'){
                    include("main/lichsudonhang.php");
                }elseif($tam=='xemdonhang'){
                    include("main/xemdonhang.php");
                }elseif($tam=='thaydoimatkhau'){
                    include("main/doimatkhau.php");
                }else{
                    include("main/index.php");
                }
                ?>
            </div>
        </div>
    </div>
</div>
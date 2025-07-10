<?php
    if(isset($_GET['trang'])){
        $page = $_GET['trang'];
    }else{
        $page = 1;
    }

    if($page==1){
        $begin = 0;
    }else{
        $begin = ($page * 12) - 12;
    }

    $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tinhtrang=1  ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin,12";
    $query_pro = mysqli_query($mysqli,$sql_pro);
?>
<h3>Sản phẩm mới nhất</h3>
                <div class="row">
                    <?php
                    while($row = mysqli_fetch_array($query_pro)){
                    ?>
                    <div class="col-md-3">
                        <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">
                            <img class="img img-responsive" width="100%" height="270px" src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']?>">
                            <p class="title_product"><?php echo $row['tensanpham']?></p>
                            <p class="price_product">Giá: <?php echo number_format($row['giasp'],0,',','.').' VNĐ'?> </p>
                            <p style="text-align:center;color:#d1d1d1;"><?php echo $row['tendanhmuc']?></p>
                        </a>
                        <p style="text-align:center;"><button onclick="xemnhanh(<?php echo $row['id_sanpham']?>)" data-toggle="modal" data-target="#xemnhanh" class="btn btn-success" value="Xem nhanh">Xem nhanh</button></p>
                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- <div style="clear:both;"></div> -->
                <style>
                    ul.list_trang li{
                        float:left;
                        background: burlywood ;
                        display: block;
                        margin: 3px;
                    }
                    ul.list_trang{
                        padding: 0;
                        margin: 0;
                        list-style: none;
                    }
                    ul.list_trang li a{
                        color:black;
                        text-align: center;
                        text-decoration: none;
                        padding: 8px ;
                        
                    }
                    ul.list_trang li:hover a{
                        cursor: pointer;
                    }
                </style>
                <?php
                $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham WHERE tbl_sanpham.tinhtrang=1");
                $row_count = mysqli_num_rows($sql_trang);
                $trang= ceil($row_count/12) ;
                ?>

                <p>Trang hiện tại: <?php echo $page ?> / <?php echo $trang ?></p>

                <ul class="list_trang">
                    <?php
                    for($i=1;$i<=$trang;$i++){
                    ?>
                        <li <?php if($i==$page){echo 'style="background: red;"';} else{echo '';} ?>>
                            <a href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

<!-- Modal -->
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><span id="title_product"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="hinhanh_sanpham">
            <span id="product_image"></span>
            <form method="POST" id="form_data">
                <div style="width:300px;" >
                    <h3 style="margin: 0;"><span id="title_product"></span></h3>
                    <p>Mã sản phẩm: <b><span id="masp"></span></b></p>
                    <p>Giá sản phẩm: <b><span id="giasp"></span></b></p>
                    <p>Hãng :<b><span id="tendanhmuc"></span></b> </p>
                    <!-- <p><input class="themgiohang" type="submit" name="themgiohang" value="Thêm giỏ hàng"></p> -->
                    <p><button type="submit" name="themgiohang" class="btn btn-danger">Thêm giỏ hàng</button></p>
                </div>
            </form>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
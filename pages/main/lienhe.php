<h3>Liên hệ</h3>
<?php
    $sql_lh = "SELECT * FROM tbl_lienhe WHERE id_lienhe=1";
    $query_lh = mysqli_query($mysqli,$sql_lh);

?>

    <?php
    while($dong = mysqli_fetch_array($query_lh)){
    ?>
    <p><?php echo $dong['thongtinlienhe']?></p>
    <?php
    }
    ?>
<h4>Gửi thông báo đến với chúng tôi</h4>

<form method="POST" action="pages/main/thongtinlienhe.php">
  <div class="form-group">
    <label>Họ và tên</label>
    <input type="text" class="form-control" name = "hoten" required placeholder="Name...">
  </div>
  <div class="form-group">
    <label>Số điện thoại</label>
    <input type="text" class="form-control" name = "phone" required placeholder="Phone...">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name = "email" required placeholder="name@gmail.com">
  </div>
  <div class="form-group">
    <label>Ghi chú</label>
    <textarea name="note" class="form-control" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary" name="guilienhe">Gửi thông báo</button>
</form>


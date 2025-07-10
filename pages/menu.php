<?php
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>
<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
  unset($_SESSION['dangky']);
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark menuu" style="width:100%;position:fixed; top:0; z-index: 1000; padding:0 20px;">
  <a class="navbar-brand" href="index.php"><img src="images/logo1.png" height="60px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fa fa-house"></i> Trang chủ<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?quanly=gioithieu">Giới thiệu</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sản phẩm</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
          ?>
            <a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a>
          <?php
          }
          ?>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="index.php?quanly=tintuc"><i class="fa fa-newspaper"></i> Tin tức</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php?quanly=lienhe"><i class="fa fa-envelopes-bulk"></i> Liên hệ</a></li>

    </ul>
    
    <form class="form-inline my-2 my-lg-0" action="index.php?quanly=timkiem" method="POST">
      <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm..." aria-label="Search" name="tukhoa">
      <button style="padding:0; border-radius:50%;" class="btn btn-outline-success my-2 my-sm-0" type="submit" name="timkiem"><i style="margin:0;padding:7px;" class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <li class="cart">
        <a href="index.php?quanly=giohang"><i class="fa-solid fa-cart-shopping"></i></a>
    </li>
    
    <ul id="nav">
      <li>
        <a class="icon" style="padding:5px;" href=""><i class="icon-user fa-solid fa-user"></i></i></a>
        <ul class="subnav">
          <?php
          if (isset($_SESSION['dangky'])) {
          ?>
            <li class="nav-item"><a class="nav-link" href="index.php?quanly=lichsudonhang">Lịch sử đơn hàng</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?quanly=thaydoimatkhau">Đổi mật khẩu</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?dangxuat=1">Đăng xuất</a></li>
          <?php
          } else {
          ?>
            <li class="nav-item"><a class="nav-link" href="index.php?quanly=dangky">Đăng ký | Đăng nhập</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
    </ul>
    <li style="display:inline-block;list-style:none; margin-left:5px;">
      <?php
      if (isset($_SESSION['dangky'])) {
        echo '<span style="color:white;">' . 'Xin chào: ' . $_SESSION['dangky'] . '</span>';
      }
      ?>
    </li>

  </div>
</nav>
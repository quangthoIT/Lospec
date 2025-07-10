<?php 
    session_start();
    include('config/config.php');
    if(isset($_POST['dangnhap'])){
        $taikhoan = $_POST['username'];
        $matkhau = md5($_POST['password']);
        $sql = "SELECT * FROM tbl_admin WHERE username='".$taikhoan."' AND password='".$matkhau."' LIMIT 1";
        $row = mysqli_query($mysqli,$sql);
        $count = mysqli_num_rows($row);
        if($count>0){
            $_SESSION['dangnhap'] = $taikhoan;
            header("Location:index.php");
        }
        else{
            echo '<script>
                    alert("Tài khoản hoặc mật khẩu không đúng");
                    window.location.href="login.php";
                </script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./css/stylelogin.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="logo text-center">
  <h1><img src="../images/Logo1.png" width="10%"></h1>
</div>
<div class="wrapper">
  <div class="inner-warpper text-center">
    <h2 class="title">Welcome to Admin</h2>
    <form action="" id="formvalidate" method="POST">
      <div class="input-group">
        <label class="palceholder" for="userName">User Name</label>
        <input class="form-control" name="username" id="userName" type="text" placeholder=""/>
        <span class="lighting"></span>
      </div>
      <div class="input-group">
        <label class="palceholder" for="userPassword">Password</label>
        <input class="form-control" name="password" id="userPassword" type="password" placeholder=""/>
        <span class="lighting"></span>
      </div>

      <button type="submit" id="login" name="dangnhap">Login</button>
      <div class="clearfix supporter">
        <div class="pull-left remember-me">
          <input id="rememberMe" type="checkbox">
          <label for="rememberMe">Remember Me</label>
        </div>
        <a class="forgot pull-right" href="#">Forgot Password?</a>
      </div>
    </form>
  </div>
  <div class="signup-wrapper text-center">
    <a href="#">Don't have an accout? <span class="text-primary">Create One</span></a>
  </div>
</div>

<!-- partial -->
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script><script  src="./js/script.js"></script>

</body>
</html>

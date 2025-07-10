<?php
    session_start();
    include("admin/config/config.php"); 
    $loi = "";
    $email = "";
    if(isset($_POST['guiyeucau'])){
      $email = $_POST['email'];
      $sql = "SELECT * FROM tbl_dangky WHERE email='".$email."' LIMIT 1 ";
      $row = mysqli_query($mysqli,$sql);
      $count = mysqli_num_rows($row);
      
      if (empty($email)) {
        $loi = "";
      }
      if ($count > 0) {
        $matkhaumoi_chuamahoa = rand(0,999999); // Tạo mật khẩu ngẫu nhiên dạng plain text
        $matkhaumoi_damahoa = md5($matkhaumoi_chuamahoa);//mã hóa mật khẩu để thêm vào database
        $sql_update = "UPDATE tbl_dangky SET matkhau='".$matkhaumoi_damahoa."' WHERE email='".$email."' ";
        mysqli_query($mysqli,$sql_update);
        //echo 'Đã cập nhật';
        GuiMatKhau($email,$matkhaumoi_chuamahoa);
      }
      else{
        $loi = "Email của bạn chưa đăng ký bên Website chúng tôi";
      }
    }
?>

<?php
function GuiMatKhau($email,$matkhaumoi)
{
  require "lib/PHPMailer-master/src/PHPMailer.php";
  require "lib/PHPMailer-master/src/SMTP.php";
  require 'lib/PHPMailer-master/src/Exception.php';
  $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true:enables exceptions
  try {
    $mail->SMTPDebug = 0; //0,1,2: chế độ debug
    $mail->isSMTP();
    $mail->CharSet  = "utf-8";
    $mail->Host = 'smtp.gmail.com';  //SMTP servers
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = 'doublet2024uth@gmail.com'; // SMTP username
    $mail->Password = 'jlakjjhkokvgdjlx';   // SMTP password
    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
    $mail->Port = 465;  // port to connect to                
    $mail->setFrom('doublet2024uth@gmail.com', 'Double T Shop');
    $mail->addAddress($email);
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Cấp lại mật khẩu';
    $noidungthu = "<p>Mật khẩu mới của bạn là: {$matkhaumoi}</p>";
    $mail->Body = $noidungthu;
    $mail->smtpConnect(array(
      "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
        "allow_self_signed" => true
      )
    ));
    $mail->send();
    echo '<script>
              alert("Đã gửi mail cấp mật khẩu mới tới bạn thành công");
              window.location.href="dangky-dangnhap.php";
          </script>';
    
  } catch (Exception $e) {
    echo 'Error: Loi ', $mail->ErrorInfo;
  }
}
?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<form method="POST" style="width:600px;" class="border border-primary boder-2 m-auto p-2">
  <h3 style="text-align:center;">Quên mật khẩu</h3>
  <?php if($loi!=""){ ?>
    <div class="alert alert-danger"><?php echo $loi?> </div>
  <?php
  }
  ?>
  <div class="form-group">
    <label for="email">Nhập Email bạn đã đăng ký tài khoản</label>
    <input value="<?php echo $email ?>" type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
  </div>
  <button type="submit" name="guiyeucau" value="nutgui" class="btn btn-primary">Gửi yêu cầu</button>
</form>
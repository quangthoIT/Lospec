<?php
session_start();
include("admin/config/config.php"); // Ensure the correct path

if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']); // Consider using password_hash for better security
    $loi = "";

    $sql_dem = mysqli_query($mysqli, "SELECT * FROM tbl_dangky WHERE tenkhachhang='$tenkhachhang' OR email='$email'");
    $row_count = mysqli_num_rows($sql_dem);
    $dem = ceil($row_count);
    // Kiểm tra username hoặc email xem có trùng không
    if ($dem >0) {
        $loi .= "Tài khoản đã tồn tại. <br>";
    }

    
    if (strlen($_POST['matkhau']) < 8) {
        $loi .= "Mật khẩu phải có ít nhất 8 ký tự. <br>";
    }

    // Kiểm tra email (sử dụng hàm filter_var)
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $loi .= "Email không hợp lệ. <br>";
    }

    if ($loi == "") {
        $sql_dangky = mysqli_query($mysqli,"INSERT INTO tbl_dangky(tenkhachhang,email,matkhau) VALUE ('".$tenkhachhang."','".$email."','".$matkhau."')");
        if($sql_dangky){
            echo '<p>Bạn đã đăng ký tài khoản thành công</p>';
            $_SESSION['dangky'] = $tenkhachhang;

            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
            header('Location:index.php');
        } else {
            $loi = "Có lỗi xảy ra khi cập nhật dữ liệu.";
        }
    }

    if ($loi != "") {
        ?>
            <div class="alert text-center">
                <?= $loi ?>
                <button class="btn btn-primary tro" onclick="history.back()">Trở lại</button>
            </div>
        <?php
    }
}

if(isset($_POST['dangnhap'])){
    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']);
    $sql = "SELECT * FROM tbl_dangky WHERE email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
    $row = mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);
    if($count>0){
        $row_data= mysqli_fetch_array($row);
        $_SESSION['dangky'] = $row_data['tenkhachhang'];
        $_SESSION['id_khachhang'] = $row_data['id_dangky'];
        header("Location:index.php");
    }
    else{
        echo '<p style="color:red;">"Tài khoản hoặc mật khẩu không đúng"</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Đăng nhập</title>
    <link rel="stylesheet" href="./css/styleloginlogout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <h2 style="text-align:center">Sign in/up</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook-f fa-xl" style="color: #B197FC;"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google-plus-g fa-xl" style="color: #FFD43B;"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-linkedin-in fa-xl" style="color: #9337be;"></i></a>
                </div>
                <span>Or use your email for registration</span>
                <input type="text" placeholder="Name" name="hovaten" required />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="matkhau" required />
                <button type="submit" class="tro" name="dangky">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-facebook-f fa-xl" style="color: #B197FC;"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-google-plus-g fa-xl" style="color: #FFD43B;"></i></a>
                    <a href="#" class="social"><i class="fa-brands fa-linkedin-in fa-xl" style="color: #9337be;"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="matkhau" required  />
                <a class="forgot" href="quenmatkhau.php">Forgot your password?</a>
                <button type="submit" class="tro" name="dangnhap">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost tro" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost tro" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        <script>
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            signUpButton.addEventListener('click', () => {
                container.classList.add('right-panel-active');
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove('right-panel-active');
            });
        </script>
    </div>
</body>
</html>

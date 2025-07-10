
<?php 
if(isset($_POST['doimatkhau'])){
    $taikhoan = $_POST['email'];
    $matkhau_cu = md5($_POST['password_cu']);
    $matkhau_moi = md5($_POST['password_moi']);  // Store new password in a separate variable
    
    $sql = "SELECT * FROM tbl_dangky WHERE email='".$taikhoan."' AND matkhau='".$matkhau_cu."' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    
    if($count > 0){
        $sql_update = mysqli_query($mysqli, "UPDATE tbl_dangky SET matkhau='".$matkhau_moi."' WHERE email='".$taikhoan."'");
        echo '<script>
                alert("Đã thay đổi mật khẩu thành công");
                window.location.href="index.php";
            </script>';
    } else {
        echo '<script>
                alert("Tài khoản hoặc mật khẩu không đúng");
                window.location.href="index.php";
            </script>';
    }
}
?>
<!-- Button to trigger form display -->
<button href="#" style="display:none;" class="place-btn doimatkhau">Đổi mật khẩu</button>

<form action="" method="POST" id="password-change-form">
    <div class="modal js-modal">
        <div class="modal-container js-modal-container">
            <div class="modal-close js-modal-close">
                <i class="fa fa-xmark"></i>
            </div>
            <header class="modal-header">
                THAY ĐỔI MẬT KHẨU
            </header>

            <div class="modal-body">
                <label for="email" class="modal-label">
                    <i class="fa-regular fa-user"></i>
                    Tài khoản
                </label>
                <input id="email" type="text" name="email" class="modal-input" placeholder="username@gmail.com">

                <label for="password_cu" class="modal-label">
                    <i class="fa fa-lock"></i>
                    Mật khẩu cũ
                </label>
                <input id="password_cu" type="password" name="password_cu" class="modal-input" placeholder="Mật khẩu cũ">

                <label for="password_moi" class="modal-label">
                    <i class="fa fa-lock"></i>
                    Mật khẩu mới
                </label>
                <input id="password_moi" type="password" name="password_moi" class="modal-input" placeholder="Nhập mật khẩu mới">

                <button type="submit" name="doimatkhau" id="buy-tickets">Đổi mật khẩu</button>
            </div>
            <footer class="modal-footer">
                <p class="modal-help">Need <a href="index.php?quanly=lienhe">Help?</a></p>
            </footer>
        </div>
    </div>
</form>

<script>
    window.onload = function() {
        // Tự động nhấn nút "Đổi mật khẩu" khi trang tải xong
        document.querySelector('.place-btn.doimatkhau').click();
    }
</script>

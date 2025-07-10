
<?php
    include('../../admin/config/config.php');
    if(isset($_POST['guilienhe'])){
        $username = $_POST['hoten'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $status = 1;

        $sql = "INSERT INTO tbl_thongtinlienhe(email,username,phone,note,statuss) VALUE('".$email."','".$username."','".$phone."','".$note."','".$status."')";
        $row = mysqli_query($mysqli,$sql);
        echo '<script>
                alert("Đã gửi thông báo thành công");
                window.location.href="../../index.php?quanly=lienhe";
            </script>';
    }
?>
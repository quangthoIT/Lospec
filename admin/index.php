<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/css/styleadmin.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <title>Admin</title>
</head>

<body>
    <h1 class="title_admin">Welcome to Admin</h1>
    <div class="wrapper">
        <?php
        include("config/config.php");
        include("modules/header.php");
        include("modules/menu.php");
        include("modules/main.php");
        include("modules/footer.php");
        ?>
    </div>
    <script>
        CKEDITOR.replace('tomtat');
        CKEDITOR.replace('noidung');
        CKEDITOR.replace('thongtinlienhe');
        CKEDITOR.replace('gioithieu');
    </script>


    <script>
        $(document).ready(function() {
            thongke();

            var char = new Morris.Area({
                element: 'chart',
                xkey: 'date',
                ykeys: ['order', 'sales', 'quantity'], // Match with data keys
                labels: ['Đơn hàng', 'Doanh thu', 'Số lượng bán ra']
            });

            $('.select-date').change(function() {
                var thoigian = $(this).val();
                var text = '';

                if (thoigian === '7ngay') {
                    text = '7 ngày qua';
                } else if (thoigian === '30ngay') {
                    text = '30 ngày qua';
                } else if (thoigian === '90ngay') {
                    text = '90 ngày qua';
                } else {
                    text = '365 ngày qua';
                }

                $.ajax({
                    url: "modules/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        thoigian: thoigian
                    },
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus + ": " + errorThrown);
                        $('#text-date').text("Error loading data");
                    }
                });
            });

            function thongke() {
                var text = '365 ngày qua';

                $.ajax({
                    url: "modules/thongke.php",
                    method: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        char.setData(data);
                        $('#text-date').text(text);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus + ": " + errorThrown);
                        $('#text-date').text("Error loading data");
                    }
                });
            }
        });
    </script>
    <script>
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview').html('<img src="' + event.target.result + '" width="300" height="auto"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }
        $("#image").change(function() {
            imagePreview(this);
        });
    </script>

</body>

</html>
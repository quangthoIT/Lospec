<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>LOSPEC SHOP</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            session_start();
            include("admin/config/config.php");
            include("pages/menu.php");
            include("pages/slider.php");
            include("pages/main.php");
            include("pages/footer.php");
            ?>
        </div>
    </div>

    <script>
        // Show the first tab and hide the rest
        $('#tabs-nav li:first-child').addClass('active');
        $('.tab-content').hide();
        $('.tab-content:first').show();

        // Click function
        $('#tabs-nav li').click(function() {
            $('#tabs-nav li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').hide();

            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn();
            return false;
        });
    </script>

    <script>
        function xemnhanh($id) {
            var product_id = $id;
            $.ajax({
                url: "pages/ajax/xemnhanh.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id
                },
                success: function(data) {
                    $("#title_product").text(data.tensanpham);
                    $("#tendanhmuc").text(data.tendanhmuc);
                    $("#masp").text(data.masp);
                    $("#giasp").text(formatNumber(data.giasp) +'VNĐ');
                    $("#product_image").html('<img width="300%" height="auto" src="admin/modules/quanlysp/uploads/' + data.hinhanh + '">');
                    $("#form_data").attr("action", "pages/main/themgiohang.php?idsanpham=" + product_id);
                }
            })
        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    </script>

    <script>
        // set index and transition delay
        let index = 0;
        let transitionDelay = 7000;

        // get div containing the slides
        let slideContainer = document.querySelector(".slideshow");
        // get the slides
        let slides = slideContainer.querySelectorAll(".slide");

        // set transition delay for slides
        for (let slide of slides) {
            slide.style.transition = `all ${transitionDelay/1000}s linear`;
        }

        // show the first slide
        showSlide(index);

        // show a specific slide
        function showSlide(slideNumber) {
            slides.forEach((slide, i) => {
                slide.style.display = i == slideNumber ? "block" : "none";
            });
            // next index
            index++;
            // go back to 0 if at the end of slides
            if (index >= slides.length) {
                index = 0;
            }
        }

        // transition to next slide every x seconds
        setInterval(() => showSlide(index), transitionDelay);
    </script>

    <script>
        const doi = document.querySelectorAll('.doimatkhau')
        const modal = document.querySelector('.js-modal')
        const modalClose = document.querySelector('.js-modal-close')
        const modalContainer = document.querySelector('.js-modal-container')
        //Hàm hiển thị form đổi mật khẩu
        function show() {
            modal.classList.add('open')
        }
        //Hàm ẩn đi form đổi mật khẩu
        function remove() {
            modal.classList.remove('open')
        }

        for (const buyBtn of doi) {
            buyBtn.addEventListener('click', show)
        }

        modalClose.addEventListener('click', remove)

        modal.addEventListener('click', remove)

        modalContainer.addEventListener('click', function(event) {
            event.stopPropagation()
        })
    </script>

</body>
<script src="https://www.paypal.com/sdk/js?client-id=AQKrjCsj_SRLPTKVRvLP2TMcky4_HGKGUxb23z0RVpqiZPXQkTlxGhXrKoN49n-vvsgs98EHPwFsn7LF&currency=USD"></script>

<script>
    paypal.Buttons({
        style: {
            shape: "rect",
            layout: "vertical",
            color: "gold",
            label: "paypal",
        },
        createOrder: function(data, actions) {
            var tien = document.getElementById('tongtien').value;
            // Sửa lại từ "purcharse_units" thành "purchase_units"
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: tien
                    }
                }]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                // Sửa "purcharse_units" thành "purchase_units"
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                window.location.replace('http://localhost/lospecshop/index.php?quanly=camon&thanhtoan=paypal')
            });
        },
        onCancle:function(data){
            window.location.replace('http://localhost/lospecshop/index.php?quanly=thongtinthanhtoan')
        }
    }).render('#paypal-button-container');
</script>
</html>
<?php
$sql_pro = "SELECT * FROM tbl_baiviet WHERE tinhtrang = 1  ORDER BY id DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);

?>

<div class="row">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <div class="col-md-3">
            <a href="index.php?quanly=baiviet&id=<?php echo $row_pro['id'] ?>">
                <img class="img img-responsive" width="100%" height="250px" src="admin/modules/quanlybaiviet/uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title_product">Tên bài viết: <?php echo $row_pro['tenbaiviet'] ?></p>
            </a>
            <p style="margin:5px" class="title_product">Tóm tắt: <?php echo $row_pro['tomtat'] ?></p>
        </div>
    <?php
    }
    ?>
</div>
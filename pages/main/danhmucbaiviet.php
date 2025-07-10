<?php
$sql_pro = "SELECT * FROM tbl_baiviet WHERE tbl_baiviet.id_danhmuc='$_GET[id]'  ORDER BY id DESC";
$query_pro = mysqli_query($mysqli, $sql_pro);
//get ten danh muc
$sql_cate = "SELECT * FROM tbl_danhmucbaiviet WHERE tbl_danhmucbaiviet.id_baiviet='$_GET[id]' LIMIT 1";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);


?>

<h3>Danh mục bài viết: <span style="text-transform:uppercase;"><?php echo $row_title['tendanhmuc_baiviet'] ?></span> </h3>
<div class="row">
    <?php
    while ($row_pro = mysqli_fetch_array($query_pro)) {
    ?>
        <div class="col-md-3">
            <a href="index.php?quanly=baiviet&id=<?php echo $row_pro['id'] ?>">
                <img class="img img-responsive" width="100%" src="admin/modules/quanlybaiviet/uploads/<?php echo $row_pro['hinhanh'] ?>">
                <p class="title_product">Tên bài viết: <?php echo $row_pro['tenbaiviet'] ?></p>
            </a>
            <p style="margin:5px" class="title_product">Tóm tắt: <?php echo $row_pro['tomtat'] ?></p>
        </div>
    <?php
    }
    ?>
</div>
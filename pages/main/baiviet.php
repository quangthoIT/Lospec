<?php
$sql_pro = "SELECT * FROM tbl_baiviet WHERE tbl_baiviet.id='$_GET[id]'  LIMIT 1";
$query_pro = mysqli_query($mysqli, $sql_pro);
$query_all = mysqli_query($mysqli, $sql_pro);

$row_baiviet_title = mysqli_fetch_array($query_pro);

?>

<h3>Bài viết: <span style="text-transform:uppercase;"><?php echo $row_baiviet_title['tenbaiviet'] ?></span> </h3>
<ul class="baiviet">
    <?php
    while ($row_pro = mysqli_fetch_array($query_all)) {
    ?>
        <li>
            <p><?php echo $row_pro['noidung'] ?></p>
        </li>
    <?php
    }
    ?>
</ul>
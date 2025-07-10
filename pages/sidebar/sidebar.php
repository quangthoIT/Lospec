<div class="side_bar">
    <h5>Danh mục sản phẩm</h5>
    <ul class="list_sidebar">
    <?php
        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
        $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
        while($row = mysqli_fetch_array($query_danhmuc)){
    ?>
    <li><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['id_danhmuc']?>"><?php echo $row['tendanhmuc']?></a></li>
    <?php
    }
    ?>
    </ul>
    <hr/>
    <h5>Danh mục bài viết</h5>
    <ul class="list_sidebar">
    <?php
        $sql_danhmuc_baiviet = "SELECT * FROM tbl_danhmucbaiviet ORDER BY id_baiviet DESC";
        $query_danhmuc_baiviet = mysqli_query($mysqli,$sql_danhmuc_baiviet);
        while($row = mysqli_fetch_array($query_danhmuc_baiviet)){
    ?>
    <li><a href="index.php?quanly=danhmucbaiviet&id=<?php echo $row['id_baiviet']?>"><?php echo $row['tendanhmuc_baiviet']?></a></li>
    <?php
    }
    ?>
    </ul>
</div>
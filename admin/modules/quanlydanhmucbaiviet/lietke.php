<?php
    $sql_lietke_danhmucbaiviet = "SELECT * FROM tbl_danhmucbaiviet ORDER BY thutu DESC";
    $query_lietke_danhmucbaiviet = mysqli_query($mysqli,$sql_lietke_danhmucbaiviet);
?>

<h3>Danh mục bài viết</h3>
<table border="1" width="100%" style="border-collapse:collapse;" >
    <tr>
        <th>Id</th>
        <th>Tên danh mục bài viết</th>
        <th>Quản lý</th>
    </tr>
    <?php 
    $i = 0;
    while($row= mysqli_fetch_array($query_lietke_danhmucbaiviet)){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['tendanhmuc_baiviet'] ?></td>
        <td>
            <a href="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $row['id_baiviet'] ?>">Xóa</a>  | 
            <a href="?action=quanlydanhmucbaiviet&query=sua&idbaiviet=<?php echo $row['id_baiviet'] ?>">Sửa</a>
        </td>
    </tr>
    <?php
    }
    ?>

</table>
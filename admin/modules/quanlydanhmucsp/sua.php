<?php
    $sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1 ";
    $query_sua_danhmucsp = mysqli_query($mysqli,$sql_sua_danhmucsp);
?>

<h3>Sửa danh mục sản phẩm</h3>
<table border="1" width="50%" style="border-collapse:collapse;" >
    <form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" >
        <?php 
        while($dong = mysqli_fetch_array($query_sua_danhmucsp)){
        ?>
        <tr>
            <td>Tên danh mục</td>
            <td><input type="text" name="tendanhmuc" value="<?php echo $dong['tendanhmuc'] ?>"></td>

         </tr>
         <tr>
            <td>Thứ tự </td>
            <td><input type="text" name="thutu" value="<?php echo $dong['thutu'] ?>"></td>

        </tr>
        <tr>
            <!-- <td colspan="2"><input type="submit" value="Sửa danh mục sản phẩm" name="suadanhmuc" ></td> -->
            <td colspan="2"><button type="submit" name="suadanhmuc" class="btn btn-primary">Sửa danh mục sản phẩm</button></td>

        </tr>
        <?php
        }
        ?>
    </form>
</table>
<?php
    $sql_lienhe = "SELECT * FROM tbl_lienhe WHERE id_lienhe=1 ";
    $query_lienhe = mysqli_query($mysqli,$sql_lienhe);
?>
<h3>Thông tin liên hệ</h3>
<table border="1" width="100%" style="border-collapse:collapse;" >
    <?php 
        while($dong = mysqli_fetch_array($query_lienhe)){
    ?>
    <form method="POST" action="modules/thongtinweb/xuly.php?id=<?php echo $dong['id_lienhe']?>" enctype="multipart/form-data" >

    <tr>
        <td>Thông tin liên hệ</td>
        <td><textarea rows="10" width="100%" name="thongtinlienhe" style="resize:none;"><?php echo $dong['thongtinlienhe']?></textarea></td>
    </tr>
    <tr>
        <td>Giới thiệu website</td>
        <td><textarea rows="10" width="100%" name="gioithieu" style="resize:none;"><?php echo $dong['gioithieu']?></textarea></td>
    </tr>
    <tr>
        <!-- <td colspan="2"><input type="submit" value="Cập nhật thông tin" name="submitlienhe" ></td> -->
        <td colspan="2"><button type="submit" name="submitlienhe" class="btn btn-primary">Cập nhật thông tin</button></td>
    </tr>
    </form>
    <?php
        }
    ?>
</table>
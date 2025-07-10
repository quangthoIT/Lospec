<h3>Thêm sản phẩm</h3>
<table border="1" width="100%" style="border-collapse:collapse;" >
    <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data" >
    <tr>
        <td>Tên sản phẩm</td>
        <td><input type="text" name="tensanpham"></td>
    </tr>
    <tr>
        <td>Mã sản phẩm</td>
        <td><input type="text" name="masp"></td>
    </tr>
    <tr>
        <td>Giá sản phẩm</td>
        <td><input type="text" name="giasp"></td>
    </tr>
    <tr>
        <td>Số lượng</td>
        <td>
            <input type="text"  name="soluong">
        </td>
    </tr>
    <tr>
        <td>Hình ảnh</td>
        <td>
            <input type="file" id="image" name="hinhanh">
            <div id="preview"></div>
        </td>
    </tr>
    <tr>
        <td>Tóm tắt</td>
        <td><textarea rows="10" width="100%" name="tomtat"></textarea></td>
    </tr>
    <tr>
        <td>Nội dung</td>
        <td><textarea rows="10" width="100%" name="noidung"></textarea></td>
    </tr>

    <tr>
        <td>Danh mục sản phẩm</td>
        <td>
            <select name="danhmuc">
                <?php
                $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
                while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                ?>
                <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
                <?php    
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tình trạng </td>
        <td>
            <select name="tinhtrang">
                <option value="1">Kích hoạt</option>
                <option value="0">Ẩn</option>
            </select>
        </td>
    </tr>
    <tr>
        <!-- <td colspan="2"><input type="submit" value="Thêm sản phẩm" name="themsanpham" ></td> -->
        <td colspan="2"><button type="submit" name="themsanpham" class="btn btn-primary">Thêm sản phẩm</button></td>

    </tr>
    </form>
</table>
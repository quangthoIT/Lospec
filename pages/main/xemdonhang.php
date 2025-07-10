<?php
    $sql_lietke_dh = "SELECT * FROM tbl_cart_details,tbl_sanpham 
    WHERE tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
    AND tbl_cart_details.code_cart='$_GET[code]'
    ORDER BY tbl_cart_details.id_cart_details DESC";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
?>

<table border="1"  width="100%" style="border-collapse:collapse;text-align:center;" >
    <tr>
        <th>Id</th>
        <th>Mã đơn hàng</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thành tiền</th>

    </tr>
    <?php 
    $i = 0;
    $tongtien =0;
    while($row= mysqli_fetch_array($query_lietke_dh)){
        $thanhtien = $row['soluongmua'] * $row['giasp'];
        $tongtien +=$thanhtien;
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['code_cart'] ?></td>
        <td><?php echo $row['tensanpham'] ?></td>
        <td><img src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh']?>" width="100px";height:100px</td>
        <td><?php echo $row['soluongmua'] ?></td>
        <td><?php echo number_format($row['giasp'],0,',','.') ?></td>
        <td><?php echo number_format($row['giasp'] *$row['soluongmua'],0,',','.').' VNĐ'?></td>
    </tr>
    <tr>
        
    </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="6">
            <p style="text-align:center; color: red; font-size:20px ; font-weight:800;">Tổng tiền: <?php echo number_format($tongtien,0,',','.').' VNĐ' ?></p>
        </td>
    </tr>

</table>
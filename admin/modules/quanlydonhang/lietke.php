<h3>Danh sách đơn hàng</h3>
<?php
    $sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang = tbl_dangky.id_dangky ORDER BY tbl_cart.id_cart DESC";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
?>

<table border="1" width="100%" style="border-collapse:collapse;" >
    <tr>
        <th>Id</th>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Tình trạng</th>
        <th>Ngày đặt</th>
        <th>Quản lý</th>
        <th>Xuất hóa đơn</th>
    </tr>
    <?php 
    $i = 0;
    while($row= mysqli_fetch_array($query_lietke_dh)){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['code_cart'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td>
            <?php if($row['cart_status']==0){
                echo '<a href="modules/quanlydonhang/xuly.php?code='.$row['code_cart'].'">Đơn hàng mới chưa xử lý</a>';
            }else{
                echo 'Đã xử lý xong';
            }
            ?>
        </td>
        <td><?php echo $row['cart_date'] ?></td>
        <td>
            <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a> 
        </td>
        <td>
            <a href="modules/quanlydonhang/indonhang.php?code=<?php echo $row['code_cart'] ?>">In đơn hàng</a>
        </td>
    </tr>
    <?php
    }
    ?>

</table>
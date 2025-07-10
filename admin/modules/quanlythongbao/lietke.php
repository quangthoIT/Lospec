<?php
    $sql_lietke_tb = "SELECT * FROM tbl_thongtinlienhe  ORDER BY id_thongtinlienhe DESC";
    $query_lietke_tb = mysqli_query($mysqli,$sql_lietke_tb);
?>

<h3>Thông báo được gửi từ Website</h3>
<table border="1" width="100%" style="border-collapse:collapse;" >
    <tr>
        <th>Id</th>
        <th>Tên người gửi</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Ghi chú</th>
    </tr>
    <?php 
    $i = 0;
    while($row= mysqli_fetch_array($query_lietke_tb)){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['username'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['phone'] ?></td>
        <td><?php echo $row['note'] ?></td>
    </tr>
    <?php
    }
    ?>

</table>
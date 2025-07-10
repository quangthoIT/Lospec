<?php
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
} else {
    $tukhoa = '';
}
$sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.tensanpham LIKE '%" . $tukhoa . "%'";
$query_pro = mysqli_query($mysqli, $sql_pro);
?>

<?php if ($tukhoa != '') { ?>
    <h3>Từ khóa tìm kiếm: <?php echo $_POST['tukhoa'] ?></h3>
    <div class="row">
        <?php
        while ($row = mysqli_fetch_array($query_pro)) {
        ?>
            <div class="col-md-3">
                <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                    <img class="img img-responsive" width="100%" height="270px" src="admin/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>">
                    <p class="title_product"><?php echo $row['tensanpham'] ?></p>
                    <p class="price_product">Giá: <?php echo number_format($row['giasp'], 0, ',', '.') . ' VNĐ' ?> </p>
                    <p style="text-align:center;color:#d1d1d1;"><?php echo $row['tendanhmuc'] ?></p>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
<?php
} else {
    echo "<h3>Không có kết quả tìm kiếm</h3>";
?>
<?php
}
?>
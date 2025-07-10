<h3>Giới thiệu</h3>
<?php
$sql_lh = "SELECT * FROM tbl_lienhe WHERE id_lienhe=1";
$query_lh = mysqli_query($mysqli, $sql_lh);

?>

<?php
while ($dong = mysqli_fetch_array($query_lh)) {
?>
    <p><?php echo $dong['gioithieu'] ?></p>
<?php
}
?>
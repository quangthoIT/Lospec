<?php
    $mysqli = new mysqli("localhost:3306","root","","lospec");

// Check connection
    if($mysqli->connect_errno){
        echo "Kết nối MySQLi lỗi " . $mysqli->connect_error;
        exit();
    }
?>
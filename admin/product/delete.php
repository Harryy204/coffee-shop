<?php
$id = $_GET['id'];
include '../../config.php';
mysqli_query($con, "DELETE FROM `sanpham` WHERE id = '$id'");
header("location: index.php");
?>
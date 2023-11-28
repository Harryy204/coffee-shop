<?php 
include '../config.php';
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM `nguoidung` WHERE id = $id");
header("location: user.php");
?>
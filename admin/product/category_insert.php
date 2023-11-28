<?php
if (isset($_POST['submit_category'])) {
    include '../../config.php';
    $category_name = $_POST['category_name'];
    mysqli_query($con, "INSERT INTO `danhmuc`(`tendm`) VALUES ('$category_name')");
    header("location: category_add.php");
}
?>

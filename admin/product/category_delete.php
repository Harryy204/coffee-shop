<?php
if (isset($_GET['id'])) {
    include '../../config.php';
    $categoryId = $_GET['id'];
    $deleteQuery = "DELETE FROM danhmuc WHERE id = $categoryId";
    mysqli_query($con, $deleteQuery);

    header("location: category_add.php");
}
?>

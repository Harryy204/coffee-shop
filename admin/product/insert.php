<?php
if (isset($_POST['submit'])) {
    include '../../config.php';
    $product_name = $_POST['tensp'];
    $product_price = $_POST['gia'];
    $product_details = $_POST['mota'];
    $category_id = $_POST['category_id'];
    $product_quantity = $_POST['soluong'];
    $current_date = date('Y-m-d');
    // thêm ảnh sản phẩm
    $image_name = $_FILES['img']['name'];
    $image_tmp = $_FILES['img']['tmp_name'];
    $image_des = "uploadimage/" . $image_name;
    // di chuyển ảnh đến thư mục lưu trữ
    move_uploaded_file($image_tmp, $image_des);

    // thêm sản phẩm
    $insertQuery = "INSERT INTO `sanpham` (`iddm`, `tensp`, `gia`, `img`, `mota`, `soluong`, `ngaynhap`) 
    VALUES ('$category_id', '$product_name', '$product_price', '$image_des', '$product_details', '$product_quantity', '$current_date')";
    
    if (mysqli_query($con, $insertQuery)) {
        header("location: index.php");
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
}
?>
